@extends('layouts.admin')
@section('page_title','Add New Warehouse Stocks')
@section('page-heading','Warehouse Stocks')
@section('content')
<div class="row"> 
    <div class="col-md-12">
        <form method="POST" id="addWarehouseStocksForm" action="{{ url('/admin/warehouse_stocks/submit') }}" enctype="multipart/form-data">
            @csrf
            <div class="card">
                @if (Session::has('success'))
                    <script>
                        swal({title: "Good job!",text: "{{ Session::get('success') }}",
                            icon: "success",timer: 4000
                            });
                    </script>
                @endif
                @if (Session::has('error'))
                    <script>
                        swal({title: "Opps!",text: "{{ Session::get('success') }}",
                            icon: "error",timer: 4000
                            });
                    </script>
                @endif
                <div class="card-header" style="background-color: rgba(30, 39, 46, 0.08)">
                    <div class="row">
                        <div class="col-md-8 d-flex align-items-center">
                            <h2 class="text-uppercase text-dark font-weight-bold custom_h_size">
                                Add Warehouse Stock's Information
                            </h2> 
                        </div>
                        <div class="col-md-4 d-flex justify-content-end">
                            <a href="{{ url('/admin/warehouse_stocks') }}" class="btn btn-sm btn-secondary font-weight-bold text-uppercase">
                                <i class="fas fa-globe"></i>&nbsp; 
                                All Available Warehouse Stock 
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body" style="background-color: rgba(30, 39, 46, 0.05)">

                    <div class="row">
                        <div class="col-md-12">
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
                                <label for="supplier_id" class="col-sm-2 col-form-label custom_form_label">
                                    Supplier Name : <span class="req_star">*</span> 
                                </label>
                                <div class="col-sm-6">
                                    @php
                                        $supplier = App\Models\Supplier::where('sup_status', 1)->get();
                                    @endphp
                                    <select name="supplier_id" id="supplier_id" class="form-control custom_form_control">
                                        <option value="" selected disabled>Select Supplier</option>
                                        @foreach ($supplier as $item)
                                            <option value="{{ $item->id }}">{{ $item->sup_name }}</option>
                                        @endforeach
                                    </select>
                                    @error('supplier_id')
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
                                        $product = App\Models\Product::where('product_status', 1)->get();
                                    @endphp
                                    <select name="product_id" id="product_id" class="form-control custom_form_control">
                                        <option value="" selected disabled>Select Product</option>
                                        @foreach ($product as $item)
                                            <option value="{{ $item->id }}">{{ $item->product_name }}</option>
                                        @endforeach
                                    </select>
                                    @error('product_id')
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