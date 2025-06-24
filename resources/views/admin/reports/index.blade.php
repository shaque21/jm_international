@extends('layouts.admin')

@section('content')
    <div class="container">
        <h1>Order Reports</h1>

        @if (Session::has('success'))
                <script>
                    swal({title: "Well Done !",text: "{{ Session::get('success') }}",
                        icon: "success",timer: 4000
                        });
                </script> 
            @endif
            @if (Session::has('error'))
                <script>
                    swal({title: "Opps !",text: "{{ Session::get('error') }}",
                        icon: "error",timer: 4000
                        });
                </script>
            @endif

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
                <div class="col-md-3">
                    <label for="product_id">Product</label>
                    <select id="product_id" name="product_id" class="form-control">
                        <option value="">All Products</option>
                        @foreach ($products as $product)
                            <option value="{{ $product->id }}" {{ request('product_id') == $product->id ? 'selected' : '' }}>
                                {{ $product->product_name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3 d-flex align-items-end">
                    <button type="submit" class="btn btn-secondary">Generate Report</button>
                </div>
            </div>
        </form>

        <!-- Display Total Quantity -->
        @if(request('product_id') && $totalQty !== null)
            <div class="alert alert-info">
                Total Quantity for <strong>{{ $products->find(request('product_id'))->product_name }}</strong>: 
                <strong>{{ $totalQty }}</strong>
            </div>
        @endif

        <!-- Reports Table -->
        <div class="card">
            <div class="card-header">
                <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#cancelledOrdersModal">
                    <i class="fas fa-ban"></i> View Cancelled Orders
                </button>
                <!-- Cancelled Orders Modal -->
                <div class="modal fade" id="cancelledOrdersModal" tabindex="-1" role="dialog" aria-labelledby="cancelledOrdersModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header bg-danger text-white">
                        <h5 class="modal-title" id="cancelledOrdersModalLabel">Cancelled Orders</h5>
                        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        </div>
                        <div class="modal-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-sm">
                            <thead class="thead-dark">
                                <tr>
                                <th>#</th>
                                <th>Product</th>
                                <th>Qty</th>
                                <th>Amount</th>
                                <th>Customer</th>
                                <th>Employee</th>
                                <th>Depo</th>
                                <th>Warehouse</th>
                                <th>Order Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($cancelledOrders as $index => $order)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $order->product->product_name ?? 'N/A' }}</td>
                                    <td>{{ $order->delivered_qty }}</td>
                                    <td>{{ number_format($order->amount, 2) }}</td>
                                    <td>{{ $order->orderMaster->customer->name ?? 'N/A' }}</td>
                                    <td>{{ $order->orderMaster->creator->name ?? 'N/A' }}</td>
                                    <td>{{ $order->orderMaster->depo->depo_name ?? 'N/A' }}</td>
                                    <td>{{ $order->orderMaster->warehouse->name ?? 'N/A' }}</td>
                                    <td>{{ $order->orderMaster->order_date }}</td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="9" class="text-center text-danger">No cancelled orders found.</td>
                                </tr>
                                @endforelse
                            </tbody>
                            </table>
                        </div>
                        </div>
                    </div>
                    </div>
                </div>
  
            </div>
            <div class="card-body">
                <div class="table-responsive mb-2">
                    <table id="basic-datatables" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Product Name</th>
                                <th>Qty</th>
                                <th>Amount (BDT)</th>
                                <th>Customer</th>
                                <th>Employee</th>
                                <th>Depo</th>
                                <th>Warehouse</th>
                                <th>Status</th>
                                <th>Order Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orders as $index => $order)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $order->product->product_name ?? 'N/A' }}</td>
                                    <td>{{ $order->delivered_qty }}</td>
                                    <td>{{ number_format($order->amount, 2) }}</td>
                                    <td>{{ $order->orderMaster->customer->name ?? 'N/A' }}</td>
                                    <td>{{ $order->orderMaster->creator->name ?? 'N/A' }}</td>
                                    <td>{{ $order->orderMaster->depo->depo_name ?? 'N/A' }}</td>
                                    <td>{{ $order->orderMaster->warehouse->name ?? 'N/A' }}</td>
                                    <td>Delivered</td>
                                    <td>{{ $order->orderMaster->order_date }}</td>
                                    <td>
                                        <form method="POST" action="{{ route('reports.cancel', $order->orderMaster->id) }}" class="cancel-order-form d-inline">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="btn btn-danger btn-sm cancel-order-btn" title="Cancel Order">
                                                <i class="fas fa-times"></i>
                                            </button>
                                        </form>
                                    </td>
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
    $(document).ready(function() {
        // SweetAlert for cancel confirmation
        $('.cancel-order-btn').on('click', function (event) {
            event.preventDefault(); // prevent default form submission
            let form = $(this).closest('form');
            swal({
                title: 'Are you sure?',
                text: 'This will cancel the order and return stock accordingly.',
                icon: 'warning',
                buttons: ["No, cancel", "Yes, cancel it!"],
                dangerMode: true,
            }).then((willCancel) => {
                if (willCancel) {
                    form.submit(); // submit form if confirmed
                } else {
                    swal("Cancelled", "Order was not canceled.", "info");
                }
            });
        });

        $('#basic-datatables').DataTable({
            "ordering": false,
            "responsive": true,
            "autoWidth": false
        });
    });

    // Initialize Date Pickers
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