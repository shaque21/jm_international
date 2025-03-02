@extends('layouts.admin')

@section('content')
    <div class="container">
        <h1>Order Reports</h1>

        <!-- Filter Form -->
        <form method="GET" action="{{ route('reports.index') }}">
            <div class="row mb-4">
                <div class="col-md-3">
                    <label for="start_date">Start Date</label>
                    <input type="text" id="start_date" name="start_date" class="form-control"
                           value="{{ request('start_date') }}" placeholder="Select Start Date">
                </div>
                <div class="col-md-3">
                    <label for="end_date">End Date</label>
                    <input type="text" id="end_date" name="end_date" class="form-control"
                           value="{{ request('end_date') }}" placeholder="Select End Date">
                </div>
                
                <div class="col-md-3">
                    <label for="customer_id">Customer</label>
                    <select id="customer_id" name="customer_id" class="form-control">
                        <option value="">All Customers</option>
                        @foreach ($customers as $customer)
                            <option value="{{ $customer->id }}" {{ request('customer_id') == $customer->id ? 'selected' : '' }}>
                                {{ $customer->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="employee_id">Employee</label>
                    <select id="employee_id" name="employee_id" class="form-control">
                        <option value="">All Employees</option>
                        @foreach ($employees as $employee)
                            <option value="{{ $employee->id }}" {{ request('employee_id') == $employee->id ? 'selected' : '' }}>
                                {{ $employee->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="row mb-4">
                <div class="col-md-3">
                    <label for="depo_id">Depo</label>
                    <select id="depo_id" name="depo_id" class="form-control">
                        <option value="">All Depos</option>
                        @foreach ($depos as $depo)
                            <option value="{{ $depo->id }}" {{ request('depo_id') == $depo->id ? 'selected' : '' }}>
                                {{ $depo->depo_name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="warehouse_id">Warehouse</label>
                    <select id="warehouse_id" name="warehouse_id" class="form-control">
                        <option value="">All Warehouses</option>
                        @foreach ($warehouses as $warehouse)
                            <option value="{{ $warehouse->id }}" {{ request('warehouse_id') == $warehouse->id ? 'selected' : '' }}>
                                {{ $warehouse->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3 d-flex align-items-end">
                    <button type="submit" class="btn btn-secondary">Generate Report</button>
                </div>
            </div>
        </form>

        <!-- Reports Table -->
        <div class="card">
            <div class="card-body">
                <div class="table-responsive mb-2">
                    <table id="basic-datatables" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Product Name</th>
                                <th>Qty</th>
                                <th>Customer</th>
                                <th>Employee</th>
                                <th>Depo</th>
                                <th>Warehouse</th>
                                <th>Status</th>
                                <th>Order Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orders as $index => $order)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $order->product->product_name ?? 'N/A'}}</td>
                                    <td>{{ $order->delivered_qty }}</td>
                                    <td>{{ $order->orderMaster->customer->name ?? 'N/A' }}</td>
                                    <td>{{ $order->orderMaster->creator->name ?? 'N/A' }}</td>
                                    <td>{{ $order->orderMaster->depo->depo_name ?? 'N/A' }}</td>
                                    <td>{{ $order->orderMaster->warehouse->name ?? 'N/A' }}</td>
                                    <td>
                                        @if ($order->orderMaster->order_status == 1)
                                            <span class="badge badge-success">Delivered</span>
                                        @else
                                            <span class="badge badge-warning">Pending</span>
                                        @endif
                                    </td>
                                    <td>{{ $order->orderMaster->order_date }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
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
    document.addEventListener("DOMContentLoaded", function() {
            flatpickr("#start_date", {
                dateFormat: "Y-m-d",
                allowInput: true
            });
            flatpickr("#end_date", {
                dateFormat: "Y-m-d",
                allowInput: true
            });
    });

    </script>
@endsection
