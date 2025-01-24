@extends('layouts.admin')
@section('page_title','Add New Depo Stocks')
@section('page-heading','Depo Stocks')
@section('content')
<div class="row"> 
    <div class="col-md-12">
        <form method="POST" id="addDepoStocksForm" action="{{ url('/admin/depo_stocks/submit') }}" enctype="multipart/form-data">
            @csrf
            <div class="card">
                @if (Session::has('success'))
                    <script>
                        swal({title: "Good job!",text: "{{ Session::get('success') }}",
                            icon: "success",timer: 4000
                        });
                    </script>
                @endif
                @if (session('debug_stock_alert'))
                    <div>{{ session('debug_stock_alert') }}</div>
                @endif
                <div>
                    {{session('error_h')}}
                </div>
                @if (Session::has('error'))
                    dd('zdfsgdfg');
                    <script>
                        swal({title: "Opps!",text: "{{ Session::get('error') }}",
                            icon: "error",timer: 4000
                        });
                    </script>
                @endif
                @if (session('stock_alert'))
                    <script>
                        swal({
                            title: "Alert!",
                            text: "{{ session('stock_alert') }}",
                            icon: "warning",
                            timer: 4000
                        });
                    </script>
                @endif

                <div class="card-header" style="background-color: rgba(30, 39, 46, 0.08)">
                    <div class="row">
                        <div class="col-md-8 d-flex align-items-center">
                            <h2 class="text-uppercase text-dark font-weight-bold custom_h_size">
                                Add Depo Stock's Information
                            </h2> 
                        </div>
                        <div class="col-md-4 d-flex justify-content-end">
                            <a href="{{ url('/admin/depo_stocks') }}" class="btn btn-sm btn-secondary font-weight-bold text-uppercase">
                                <i class="fas fa-globe"></i>&nbsp; 
                                All Available Depo Stock 
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body" style="background-color: rgba(30, 39, 46, 0.05)">

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group row border">
                                <label for="depo_id" class="col-sm-2 col-form-label custom_form_label">
                                    Depo Name : <span class="req_star">*</span> 
                                </label>
                                <div class="col-sm-6">
                                    @php
                                        $depos = App\Models\Depo::where('depo_status', 1)->get();
                                    @endphp
                                    <select name="depo_id" id="depo_id" class="form-control custom_form_control">
                                        <option value="" selected disabled>Select Depo</option>
                                        @foreach ($depos as $item)
                                            <option value="{{ $item->id }}">{{ $item->depo_name }}</option>
                                        @endforeach
                                    </select>
                                    @error('depo_id')
                                        <span class="alert alert-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row border">
                                <label for="warehouse_id" class="col-sm-2 col-form-label custom_form_label">
                                    Warehouse Name : <span class="req_star">*</span> 
                                </label>
                                <div class="col-sm-6">
                                    @php
                                        $warehouse = App\Models\Warehouse::where('warehouse_status', 1)->get();
                                    @endphp
                                    <select name="warehouse_id" id="warehouse_id" class="form-control custom_form_control">
                                        <option value="" selected disabled>Select Warehouse</option>
                                        @foreach ($warehouse as $item)
                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('warehouse_id')
                                        <span class="alert alert-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="form-group row border">
                                <label for="product_id" class="col-sm-2 col-form-label custom_form_label">
                                    Product's Name : <span class="req_star">*</span> 
                                </label>
                                <div class="col-sm-6">
                                    @php
                                        use App\Models\WarehouseStock;
                                        use App\Models\WarehouseProductStock;

                                        $product = WarehouseStock::with(['product', 'warehouseProductStock'])
                                            ->whereHas('warehouseProductStock', function ($query) {
                                                $query->where('total_stock', '>', 0);
                                            })
                                            ->where('wr_status', 1)
                                            ->get()
                                            ->unique('product_id');


                                    @endphp
                                    <select name="product_id" id="product_id" class="form-control custom_form_control">
                                        <option value="" selected disabled>Select Product</option>
                                        @foreach ($product as $item)
                                            <option value="{{ $item->product_id }}">{{ $item->product->product_name }}</option>
                                        @endforeach
                                    </select>
                                    @error('product_id')
                                        <span class="alert alert-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row border">
                                <label for="employee_id" class="col-sm-2 col-form-label custom_form_label">
                                    Delivered To : <span class="req_star">*</span> 
                                </label>
                                <div class="col-sm-6">
                                    @php
                                        $emp = App\Models\User::where('status', 1)
                                        ->where('role_id',2)->get();
                                    @endphp
                                    <select name="employee_id" id="employee_id" class="form-control custom_form_control">
                                        <option value="" selected disabled>Select Employee</option>
                                        @foreach ($emp as $item)
                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('employee_id')
                                        <span class="alert alert-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row border">
                                <label for="quantity" class="col-sm-2 col-form-label custom_form_label">
                                    Quantity : <span class="req_star">*</span>
                                </label>
                                <div class="col-sm-6">
                                  <input type="number" id="quantity" class="form-control custom_form_control" name="quantity" value="{{ old('quantity') }}">
                                    @error('quantity')
                                        <span class="alert alert-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            {{-- <div class="form-group row border">
                                <label for="alert_stock" class="col-sm-2 col-form-label custom_form_label">
                                    Alert Stock : <span class="req_star">*</span>
                                </label>
                                <div class="col-sm-6">
                                  <input type="number" id="alert_stock" class="form-control custom_form_control" name="alert_stock" value="{{ old('alert_stock') }}">
                                    @error('alert_stock')
                                        <span class="alert alert-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div> --}}
                        </div>
                    </div>
                    
                </div>
                <div class="card-footer text-center" style="background-color: rgba(30, 39, 46, 0.05)">
                    <button class="btn btn-sm btn-secondary font-weight-bold" type="submit">Submit</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
@section('script')
<script>
    function previewFile(input){
        var file = $("input[type=file]").get(0).files[0];
 
        if(file){
            var reader = new FileReader();
 
            reader.onload = function(){
                $("#previewImg").attr("src", reader.result);
            }
 
            reader.readAsDataURL(file);
        }
    }
</script>
@endsection