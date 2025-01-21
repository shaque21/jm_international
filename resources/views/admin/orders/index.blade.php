@extends('layouts.admin')
@section('page_title','Place Orders')
@section('page-heading','Cashier')
@section('content')
<div class="row">
    <div class="col-sm-9 col-md-8">
        <div class="card card-stats card-round">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-8 d-flex align-items-center">
                        <h2 class="text-uppercase  font-weight-bold custom_h_size">
                            Order Products
                        </h2>
                    </div>
                    <div class="col-md-4 d-flex justify-content-end">
                        <a href="{{ url('/admin/products/create') }}" class="btn btn-sm btn-secondary font-weight-bold text-uppercase">
                            <i class="fas fa-cart-plus"></i>&nbsp 
                            Add new product
                        </a>
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
                                icon: "error",timer: 3000
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
                                <th >Qty<span class="order_req_star">*</span></th>
                                <th >Deliverd Qty<span class="order_req_star">*</span></th>
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
                                <td style="width: 40%;">
                                    <select name="product_id[]" class="form-control custom_form_control_order product_id">
                                        <option value="" selected disabled>Select Product</option>
                                        @foreach ($products as $product)
                                            <option data-price="{{ $product->price }}" value="{{ $product->id }}">
                                                {{ $product->product_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('product_id')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </td>
                                <td>
                                    <input type="number" name="ordered_qty[]" id="ordered_qty"
                                    class="form-control  custom_form_control_order ordered_qty">
                                    @error('ordered_qty')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </td>
                                <td>
                                    <input type="number"  name="delivered_qty[]" id="delivered_qty"
                                    class="form-control  custom_form_control_order delivered_qty">
                                    @error('delivered_qty')
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
                    Total Quantity : <b class="total">0</b>  <small class="font-weight-bold">( PCS )</small>
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
                                    <select name="customer_id" id="customer_id" class="form-control  custom_form_control_order">
                                        <option value="" selected disabled>Select Customer</option>
                                        @foreach ($customers as $item)
                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('customer_id')
                                        <span class="alert alert-danger">{{ $message }}</span>
                                    @enderror
                                    {{-- <label class="font-weight-bold" for="customer_name">Customer Name</label>
                                    <input type="text" name="customer_name" id="customer_name"
                                    class="form-control form-control-sm"> --}}
                                </td>
                            @endif
                            
                            
                            {{-- <td>
                                <label class="font-weight-bold" for="customer_mobile">Phone</label>
                                <input type="text" name="customer_mobile" id="customer_mobile"
                                class="form-control form-control-sm">
                            </td> --}}
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
                                        $depos = App\Models\Depo::where('depo_status', 1)->get();
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
                    <input type="date"  readonly class="form-control" value="{{ Carbon::now()->toDateString() }}">
                </div>
                <button class="btn btn-sm btn-block btn-success" type="submit">Save</button>
            </div>
        </div>
    </form>
    </div>
</div>
<!-- Start The Modal For show history-->
{{-- <div class="modal fade" id="historyModal">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
      <div class="modal-content">
      
        @php
            $last_order_id = App\Models\OrderDetails::max('order_master_id');
            $order_receipt = App\Models\OrderDetails::where('order_master_id',$last_order_id)->get();
        @endphp
        <!-- Modal Header -->
        <div class="modal-header">
            <h4 class="modal-title text-uppercase font-weight-bold">
                Last Order History ( {{ $order_receipt['0']->created_at->format('Y M d | h:i A') }} )
            </h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
            
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover table-sm">
                    <thead class="thead-dark">
                        <tr>
                            <th>#</th>
                            <th>Product Name</th>
                            <th>Qty</th>
                            <th>Ordered By</th>
                            <th>Delivered By</th>
                            <th>Location</th>
                            <th>Order Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orderReceipt as $key => $order)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $order->product->product_name }}</td>
                                <td>{{ $order->delivered_qty }}</td>
                                <td>{{ $order->orderMaster->customer->name }}</td>
                                <td>{{ $order->orderMaster->creator->name }}</td>
                                <td>{{ $order->orderMaster->warehouse->name }}</td>
                                <td>{{ $order->orderMaster->order_status }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
        </div>
        
        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary btn-sm btn-block" data-dismiss="modal">Close</button>
        </div>
        
      </div>
    </div>
</div> --}}
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
                <p>Loading order history...</p>
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
                Today's Sales Report
            </h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
            {{-- @php
                // use Carbon\Carbon;
                $today = Carbon::now();
                $date = date('Y-m-d',strtotime($today));
                $todays_report = App\Models\OrderDetail::where('order_date',$date)
                ->orderBy('id','DESC')->get();
                $total_amount = App\Models\OrderDetail::where('order_date',$date)->sum('amount');
                
            @endphp --}}
            <div class="table-responsive">
                <table id="basic-datatables" class="table table-bordered table-striped table-hover table-sm">
                    <thead class="thead-dark">
                        <tr>
                            <th>#</th>
                            <th>Product Name</th>
                            <th>Qty</th>
                            <th>Available Qty</th>
                            <th>Unit Price</th>
                            <th>Disc (%)</th>
                            <th>Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                        {{-- @foreach ($todays_report as $key=>$order)
                            <tr>
                                <td>{{ $key+1 }}</td>
                                <td>{{ $order->products->product_name }}</td>
                                <td>{{ $order->quantity }}</td>
                                <td>{{ $order->products->quantity }}</td>
                                <td>{{ number_format($order->unit_price,2) }}</td>
                                <td>{{ number_format($order->discount,2) }} %</td>
                                <td>{{ number_format($order->amount,2) }}</td>
                            </tr>
                        @endforeach --}}
                    </tbody>
                </table>
            </div>
            
            {{-- <h2 class="text-danger">TOTAL AMOUNT : {{ '$ '. number_format($total_amount,2) }}</h2> --}}
            
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
			});
            // add new row
            // $('.add_more').on('click',function(){
            //     var product = $('.product_id').html();
            //     var number_of_row = ($('.add_new_product tr').length - 0) + 1;
            //     var tr ='<tr><td class="no">' + number_of_row + '</td>' +
            //             '<td><select name="product_id[]" class="form-control product_id">' +
            //             product + 
            //             '</select></td>' +
            //             '<td><input type="number" name="ordered_qty[]" id="ordered_qty" class="form-control custom_form_control_order ordered_qty" ></td>' +
            //             '<td><input type="number" name="deliverd_qty[]" id="deliverd_qty" class="form-control custom_form_control_order deliverd_qty" ></td>' +
            //             '<td class="text-center"><a class="delete" href="#"><i class="fas fa-times-circle fa-lg text-danger"></i></a></td></tr>';

            //     $('.add_new_product').append(tr);
                         
            // });
            // // Remove row from table
            // $('.add_new_product').delegate('.delete','click',function(){
            //     $(this).parent().parent().remove();
            // });
            // Add new product row
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
                            <input type="number" name="ordered_qty[]" class="form-control custom_form_control_order ordered_qty" />
                        </td>
                        <td>
                            <input type="number" name="delivered_qty[]" class="form-control custom_form_control_order delivered_qty" />
                        </td>
                        <td class="text-center">
                            <a href="#" class="delete">
                                <i class="fas fa-times-circle fa-lg text-danger"></i>
                            </a>
                        </td>
                    </tr>`;
                document.querySelector(".add_new_product").insertAdjacentHTML("beforeend", newRow);
            });

            // Remove product row
            document.querySelector(".add_new_product").addEventListener("click", (e) => {
                if (e.target.closest(".delete")) {
                    e.preventDefault();
                    e.target.closest("tr").remove();
                    calculateTotalQuantity();
                }
            });

            //Total Amount that display In the right head section
            // Function to calculate total quantity
            function calculateTotalQuantity() {
                let total = 0;
                document.querySelectorAll(".delivered_qty").forEach((input) => {
                    total += parseFloat(input.value) || 0;
                });
                document.querySelector(".total").textContent = total;
            }

            // Update total when quantities change
            document.querySelector(".add_new_product").addEventListener("input", (e) => {
                if (e.target.matches(".delivered_qty")) {
                    calculateTotalQuantity();
                }
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


            

            // $(document).on('click','#order_history',function(){
            //     var last_order_id = $(this).data('id');
            //     $.ajax({
            //         url:'{{ url("/admin/orders/get-last-order-history") }}',
            //         type: 'POST',
            //         headers: {
            //             'X-CSRF-TOKEN': '{{ csrf_token() }}'
            //         },
            //         data:{last_order_id:last_order_id},
            //         success:function(data){

            //             $('.modal-body').html(data)

            //         }

            //     });
            // });

        });
    </script>
@endsection