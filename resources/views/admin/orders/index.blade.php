@extends('layouts.admin')
@section('page_title','Place Orders')
@section('page-heading','Cashier')
@section('content')
<div class="row">
    <div class="col-sm-9 col-md-8">
        <div class="card card-stats card-round">
            <div class="card-header">
                <div class="row d-flex justify-content-between align-items-center">
                    <div class="col-md-4  ">
                        <h2 class="text-uppercase  font-weight-bold custom_h_size">
                            Order Products
                        </h2>
                    </div>
                    <div class="col-md-4">
                        <a href="{{ url('/admin/products/create') }}" class="btn btn-sm btn-secondary font-weight-bold text-uppercase">
                            <i class="fas fa-cart-plus"></i>&nbsp 
                            Add new product
                        </a>
                    </div>
                    <div class="col-md-4 ">
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-sm btn-secondary font-weight-bold text-uppercase" data-toggle="modal" data-target="#userModal">
                            <i class="fas fa-user-plus"></i>&nbsp 
                            Add Customer
                        </button>
                        
                        <!-- Modal -->
                        <div class="modal fade" id="userModal" tabindex="-1" aria-labelledby="userModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg"> <!-- Optional: modal-lg, modal-xl -->
                            <div class="modal-content">
                                <div class="modal-header">
                                <h5 class="modal-title" id="userModalLabel">Add Customer Information</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                </div>
                                <div class="modal-body">
                                {{-- Your full form goes here --}}
                                <form method="POST" action="{{ url('/admin/users/customer_submit') }}" enctype="multipart/form-data">
                                    @csrf
                                    <div class="card">
                                        
                                        <div class="card-body" style="background-color: rgba(30, 39, 46, 0.05)">
                        
                                            <div class="row">
                                                <div class="col-md-6 border">
                                                    <div class="form-group row border">
                                                        <label for="name" class="col-sm-2 col-form-label custom_form_label">
                                                            Name :<span class="req_star">*</span>
                                                        </label>
                                                        <div class="col-sm-10">
                                                          <input type="text" id="name" class="form-control custom_form_control" name="name" placeholder="User Name">
                                                            @error('name')
                                                                <span class="alert alert-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 border">
                                                    <div class="form-group row border">
                                                        <label for="role_id" class="col-sm-2 col-form-label custom_form_label">
                                                            User Role :<span class="req_star">*</span> 
                                                        </label>
                                                        <div class="col-sm-10">
                                                            <select name="role_id" id="role_id" class="form-control custom_form_control">
                                                                <option value="" selected disabled>Select Role</option>
                                                                <option value="1">Admin</option>
                                                                <option value="2">Employee</option>
                                                                <option value="3" selected>Customer</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                        </div>
                                        <div class="card-footer text-center border" style="background-color: rgba(30, 39, 46, 0.05)">
                                            <button class="btn btn-sm btn-secondary font-weight-bold" type="submit">Submit</button>
                                        </div>
                                    </div>
                                </form>
                                </div>
                            </div>
                            </div>
                        </div>
                    </div>
                    @if (Session::has('success'))
                        <script>
                            swal({title: "Well Done !",text: "{{ Session::get('success') }}",
                                icon: "success",timer: 3000
                                });
                        </script> 
                    @endif
                    @if (Session::has('error'))
                        <script>
                            swal({title: "Opps !",text: "{{ Session::get('error') }}",
                                icon: "error",timer: 30000
                                });
                        </script>
                    @endif
                </div>
            </div>
            <form action="{{ url('/admin/orders/submit') }}" method="POST">
                @csrf
            <div class="card-body">
                <div class="table-responsive">
                    <table  class="table table-bordered table-hover">
                        <thead class="thead-dark">
                            <tr class="text-center">
                                <th >#</th>
                                <th >Product Name<span class="order_req_star">*</span></th>
                                
                                <th >Deliverd Qty<span class="order_req_star">*</span></th>
                                <th >Price<span class="order_req_star">*</span></th>
                                <th >Amount<span class="order_req_star">*</span></th>
                                {{-- <th style="width: 15%">Disc (%)</th>
                                <th style="width: 15%">Total<span class="order_req_star">*</span></th> --}}
                                <th  class="text-center">
                                    <a href="#" class="add_more">
                                        <i class="fas fa-plus-circle fa-lg text-success"></i>
                                    </a>
                                </th>
                            </tr>
                        </thead>
                        <tbody class="add_new_product">
                            <tr>
                                <td >1</td>
                                @php
                                    $user = Auth::user(); // Assuming the logged-in user is relevant
                                @endphp

                                @if ($user && $user->role_id == 1)
                                    <td style="width: 40%;">
                                        @php
                                            $warehouseProduct = App\Models\WarehouseStock::with(['product', 'warehouseProductStock'])
                                                ->whereHas('warehouseProductStock', function ($query) {
                                                    $query->where('total_stock', '>', 0);
                                                })
                                                ->where('wr_status', 1)
                                                ->get()
                                                ->unique('product_id');
                                        @endphp
                                        <select name="product_id[]" class="form-control form-control custom_form_control_order product_id">
                                            <option value="" selected disabled>Select Product</option>
                                            @foreach ($warehouseProduct as $product)
                                                <option value="{{ $product->product_id }}">
                                                    {{ $product->product->product_name ?? 'N/A' }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('product_id')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </td>
                                @elseif($user && $user->role_id == 2)
                                    <td style="width: 40%;">
                                        @php
                                            $depoProduct = App\Models\DepoStock::with(['product', 'depoProductStock'])
                                                ->whereHas('depoProductStock', function ($query) {
                                                    $query->where('total_stock', '>', 0);
                                                })
                                                ->where('ds_status', 1)
                                                ->get()
                                                ->unique('product_id');
                                        @endphp
                                        <select name="product_id[]" class="form-control custom_form_control_order product_id">
                                            <option value="" selected disabled>Select Product</option>
                                            @foreach ($depoProduct as $product)
                                                <option value="{{ $product->product_id }}">
                                                    {{ $product->product->product_name ?? 'N/A' }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('product_id')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </td>
                                @endif
                                <td>
                                    <input type="number"  name="delivered_qty[]" id="delivered_qty"
                                    class="form-control  custom_form_control_order delivered_qty">
                                    @error('delivered_qty')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </td>
                                <td>
                                    <input type="number" step="0.01" name="product_price[]"
                                    class="form-control custom_form_control_order product_price">
                                    @error('product_price')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </td>
                                <td>
                                    <input type="text" name="amount[]" 
                                    class="form-control custom_form_control_order amount" readonly>
                                    @error('amount')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </td>
                                
                                <td class="text-center">
                                    <a href="#" class="btn btn-danger btn-xs">
                                        <i class="fas fa-times-circle fa-lg text-white"></i>
                                    </a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-3 col-md-4">
        <div class="card card-stats card-round">
            <div class="card-header d-flex justify-content-center align-items-center">
                <h2 class="text-uppercase custom_h_size font-weight-bold">
                    Total Amount : <b class="total">0</b>  <small class="font-weight-bold">( BDT )</small>
                </h2>
            </div>
            <div class="card-body">
                <div class="btn-group btn-sm">
                    {{-- <a href="{{ url('/admin/cashier/receipt/download') }}" class="btn btn-secondary btn-sm text-uppercase font-weight-bold">
                        <i class="fas fa-file-pdf"></i>&nbsp; PDF
                    </a> --}}
                    <button type="button" class="btn btn-dark btn-sm text-uppercase font-weight-bold" data-toggle="modal" data-target="#historyModal"
                    id="order_history"  >
                        <i class="fas fa-history"></i>&nbsp; HISTORY
                    </button>
                    <button type="button" class="btn btn-danger btn-sm text-uppercase font-weight-bold" data-toggle="modal" data-target="#dailyReportModal"
                    id="daily_report">
                    <i class="fas fa-chart-bar"></i>&nbsp; REPORT
                    </button>
                </div>
                <div class="col mt-2">
                    <table class="table">
                        <tr>
                            @php
                                $user = Auth::user(); // Assuming the logged-in user is relevant
                            @endphp
                            @if($user && $user->role_id == 1 || $user && $user->role_id == 2)
                                <td>  
                                    @php
                                    $customers = App\Models\User::where('status',1)->where('role_id',3)->get();
                                    
                                    @endphp
                                    <label class="font-weight-bold" for="customer_id">Customer Name : </label><span class="order_req_star"> *</span>
                                    <select name="customer_id" id="customer_id" class="form-control custom_form_control_order select2">
                                        <option value="" selected disabled>Select Customer</option>
                                        @foreach ($customers as $item)
                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('customer_id')
                                        <span class="alert alert-danger">{{ $message }}</span>
                                    @enderror
                                    
                                </td>
                            @endif
                        </tr>
                        <tr>
                            @php
                                $user = Auth::user(); // Assuming the logged-in user is relevant
                            @endphp
                        
                            @if ($user && $user->role_id == 1) <!-- Check if the logged-in user has role_id 1 -->
                                <td>
                                    @php
                                        $warehouses = App\Models\Warehouse::where('warehouse_status', 1)->get();
                                    @endphp
                                    <label class="font-weight-bold" for="warehouse_id">Warehouse Name:</label>
                                    <span class="order_req_star"> *</span>
                                    <select name="warehouse_id" id="warehouse_id" class="form-control custom_form_control_order">
                                        <option value="" selected disabled>Select Warehouse</option>
                                        @foreach ($warehouses as $item)
                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('warehouse_id')
                                        <span class="alert alert-danger">{{ $message }}</span>
                                    @enderror
                                </td>
                            @elseif ($user && $user->role_id == 2) <!-- Check if the logged-in user has role_id 2 -->
                                <td>
                                    @php
                                        $user_id = Auth::user()->id;
                                        $depos = App\Models\Depo::with('depoStock')
                                            ->where('depo_status', 1)
                                            ->whereHas('depoStock', function ($query) use ($user_id) {
                                                $query->where('employee_id', $user_id);
                                            })
                                            ->get();
                                    @endphp
                                    <label class="font-weight-bold" for="depo_id">Depo Name:</label>
                                    <span class="order_req_star"> *</span>
                                    <select name="depo_id" id="depo_id" class="form-control custom_form_control_order">
                                        <option value="" selected disabled>Select Depo</option>
                                        @foreach ($depos as $item)
                                            <option value="{{ $item->id }}">{{ $item->depo_name }}</option>
                                        @endforeach
                                    </select>
                                    @error('depo_id')
                                        <span class="alert alert-danger">{{ $message }}</span>
                                    @enderror
                                </td>
                            @endif
                        </tr>
                        
                    </table>
                </div>
            </div>
            <div class="card-footer">
                @php
                    use Carbon\Carbon;
                @endphp
                <div class="form-group">
                    <label class="font-weight-bold" for="order_date">Date :</label>
                    <input type="text" id="order_date" name="order_date" class="form-control"
                        value="{{ old('order_date', \Carbon\Carbon::now()->toDateString()) }}"
                        placeholder="Select Date">
                </div>

                <button class="btn font-weight-bold btn-sm btn-block btn-secondary" type="submit">Confirm Order</button>
            </div>
        </div>
    </form>
    </div>
</div>
<!-- Start The Modal For show history-->

<div class="modal fade" id="historyModal">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title text-uppercase font-weight-bold">Last Order History</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal Body -->
            <div class="modal-body">
                <p>Last Order History Loading....</p>
            </div>

            <!-- Modal Footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm btn-block" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- End The Modal For show history-->
<!-- Start The Modal For daily report-->
<div class="modal fade" id="dailyReportModal">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
            <h4 class="modal-title text-uppercase font-weight-bold">
                Today's Sales Report <small>{{Carbon::now()->format('Y-m-d | h:s A')}}</small>
            </h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
            @php
                // use Carbon\Carbon;
                $user_id = Auth::user()->id;
                $today = Carbon::now()->today();
                $date = $today->format('Y-m-d');
                $daily_report = App\Models\OrderMaster::with(['orderDetails.product', 'customer', 'creator', 'warehouse'])
                                ->where('order_date', $date)
                                ->where('user_id',$user_id)
                                ->orderBy('id', 'DESC')
                                ->get();
                $total_qty = App\Models\OrderMaster::where('order_date', $date)->where('user_id',$user_id)->sum('num_of_item');
            @endphp
            <div class="table-responsive ">
                <table id="basic-datatables-reposrts" class="display table table-sm table-striped table-hover" >
                    <thead class="thead-dark">
                        <tr>
                            <th>#</th>
                            <th>Product Name</th>
                            <th>Qty</th>
                            <th>Ordered By</th>
                            <th>Delivered By</th>
                            <th>Delivered From</th>
                            <th>Order Status</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>#</th>
                            <th>Product Name</th>
                            <th>Qty</th>
                            <th>Ordered By</th>
                            <th>Delivered By</th>
                            <th>Delivered From</th>
                            <th>Order Status</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($daily_report as $key => $order)
                            @foreach ($order->orderDetails as $orderDetail)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $orderDetail->product->product_name ?? 'N/A' }}</td>
                                    <td>{{ $orderDetail->delivered_qty ?? 0 }}</td>
                                    <td>{{ $order->customer->name ?? 'N/A' }}</td>
                                    <td>{{ $order->creator->name ?? 'N/A' }}</td>
                                    <td>
                                        @if ($order->warehouse_id)
                                            {{ $order->warehouse->name ?? 'N/A' }}
                                        @elseif ($order->depo_id)
                                            {{ $order->depo->depo_name ?? 'N/A' }}
                                        @else
                                            N/A
                                        @endif
                                    </td>
                                    
                                    <td>
                                        @if ($order->order_status == 1)
                                            <span class="badge badge-success">
                                                Delivered
                                            </span>
                                        @else
                                            <span class="badge badge-danger">
                                                Pending
                                            </span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        @endforeach

                    </tbody>
                </table>
            </div>
            
            <h2 class="text-secondary">TOTAL SALE QUANTITY : {{ $total_qty }} <small>( PCS )</small></h2>
            
        </div>
        
        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary btn-sm btn-block" data-dismiss="modal">Close</button>
        </div>
        
      </div>
    </div>
</div>
<!-- End The Modal For show daily report-->
@endsection
@section('script')
    <script>
        $(document).ready(function(){
            $('#basic-datatables').DataTable({
                ordering: false,
                responsive: true,
                autoWidth: false,
			});
            $('#basic-datatables-reposrts').DataTable({
                ordering: false,
                responsive: true,
                autoWidth: false,
			});
            $('.select2').select2({
                placeholder: "Select Customer",
                allowClear: true,
                width: '100%'
            });
            document.querySelector(".add_more").addEventListener("click", (e) => {
                e.preventDefault();
                const productOptions = document.querySelector(".product_id").innerHTML;
                const rowNumber = document.querySelectorAll(".add_new_product tr").length + 1;
                const newRow = `
                    <tr>
                        <td>${rowNumber}</td>
                        <td>
                            <select name="product_id[]" class="form-control custom_form_control_order product_id">${productOptions}</select>
                        </td>
                        <td>
                            <input type="number" name="delivered_qty[]" class="form-control custom_form_control_order delivered_qty" />
                        </td>
                        <td>
                            <input type="number" step="0.01" name="product_price[]" class="form-control custom_form_control_order product_price">
                        </td>
                        <td>
                            <input type="text" name="amount[]" class="form-control custom_form_control_order amount" readonly>
                        </td>

                        <td class="text-center">
                            <a href="#" class="delete">
                                <i class="fas fa-times-circle fa-lg text-danger"></i>
                            </a>
                        </td>
                    </tr>`;
                document.querySelector(".add_new_product").insertAdjacentHTML("beforeend", newRow);
            });

            // Delete Row
            document.querySelector(".add_new_product").addEventListener("click", (e) => {
                if (e.target.closest(".delete")) {
                    e.preventDefault();
                    e.target.closest("tr").remove();
                    calculateTotalAmount();
                }
            });

            // Amount Calculation and Total Amount Update
            $(document).on('input', '.delivered_qty, .product_price', function () {
                let row = $(this).closest('tr');
                let qty = parseFloat(row.find('.delivered_qty').val()) || 0;
                let price = parseFloat(row.find('.product_price').val()) || 0;
                let amount = qty * price;
                row.find('.amount').val(amount.toFixed(2));

                // Recalculate total on input
                calculateTotalAmount();
            });

            // Function to calculate total amount
            function calculateTotalAmount() {
                let total = 0;
                document.querySelectorAll(".amount").forEach((input) => {
                    total += parseFloat(input.value) || 0;
                });
                document.querySelector(".total").textContent = total.toFixed(2);
            }

            // In case amount is manually changed (if not readonly)
            document.querySelector(".add_new_product").addEventListener("input", (e) => {
                if (e.target.matches(".amount")) {
                    calculateTotalAmount();
                }
            });
            flatpickr("#order_date", {
                dateFormat: "Y-m-d",
                defaultDate: "{{ old('order_date', \Carbon\Carbon::now()->toDateString()) }}",
                allowInput: true,
            });

            // Fetch last order history
            document.querySelector("#order_history").addEventListener("click", function () {
            const lastOrderId = this.dataset.id;

            fetch("{{ url('/admin/orders/get-last-order-history') }}", {
                method: "POST",
                headers: {
                    "X-CSRF-TOKEN": "{{ csrf_token() }}",
                    "Content-Type": "application/json",
                },
                body: JSON.stringify({ last_order_id: lastOrderId }),
            })
                .then((response) => response.text())
                .then((data) => {
                    // Insert the HTML into the modal body
                    document.querySelector("#historyModal .modal-body").innerHTML = data;
                })
                .catch((error) => console.error("Error:", error));
        });

        });
    </script>
@endsection