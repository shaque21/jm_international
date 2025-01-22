@extends('layouts.admin')

@section('content')
    <div class="container">
        <h1>Order Reports</h1>

        <!-- Filter Form -->
        <form method="GET" action="{{ route('reports.index') }}">
            <div class="row mb-4">
                <div class="col-md-3">
                    <label for="report_type">Report Type</label>
                    <select id="report_type" name="report_type" class="form-control">
                        <option value="daily" {{ $reportType === 'daily' ? 'selected' : '' }}>Daily</option>
                        <option value="monthly" {{ $reportType === 'monthly' ? 'selected' : '' }}>Monthly</option>
                        <option value="yearly" {{ $reportType === 'yearly' ? 'selected' : '' }}>Yearly</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="start_date">Start Date</label>
                    <input type="date" id="start_date" name="start_date" class="form-control"
                        value="{{ $startDate->toDateString() }}">
                </div>
                <div class="col-md-3">
                    <label for="end_date">End Date</label>
                    <input type="date" id="end_date" name="end_date" class="form-control"
                        value="{{ $endDate->toDateString() }}">
                </div>
                <div class="col-md-3 d-flex align-items-end">
                    <button type="submit" class="btn btn-secondary">Generate Report</button>
                </div>
            </div>
        </form>

        <!-- Reports Table -->
        <div class="card">
            <div class="card-body">
                @foreach ($orders as $key => $groupedOrders)
                    <h2>
                        @if ($reportType === 'daily') Date : @elseif ($reportType === 'monthly') Month : @else Year : @endif
                        {{ $key }}
                    </h2>
                    <div class="table-responsive">
                        <table id="basic-datatables" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Product Name</th>
                                    <th>Qty</th>
                                    <th>Ordered By</th>
                                    <th>Delivered By</th>
                                    <th>Location</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($groupedOrders as $index => $order)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $order->product->product_name }}</td>
                                        <td>{{ $order->delivered_qty }}</td>
                                        <td>{{ $order->orderMaster->customer->name ?? 'N/A' }}</td>
                                        <td>{{ $order->orderMaster->creator->name ?? 'N/A' }}</td>
                                        {{-- <td>{{ $order->orderMaster->warehouse->name ?? 'N/A' }}</td> --}}
                                        <td>{{ $order->orderMaster->warehouse->name ?? $order->orderMaster->depo->depo_name ?? 'N/A'}}</td>
                                        <td>
                                            @if ($order->orderMaster->order_status == 1)
                                                <span class="badge badge-success">Approved</span>
                                            @else
                                                <span class="badge badge-warning">Pending</span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endforeach
            </div>
        </div>
        
    </div>
@endsection
@section('script')
    <script>
        $(document).ready(function(){
        $('#basic-datatables').DataTable({
            ordering: false,
            responsive: true,
            autoWidth: false,
        });
    });
    </script>
@endsection



