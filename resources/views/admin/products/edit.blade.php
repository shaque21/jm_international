@extends('layouts.admin')
@section('page_title','Edit Products')
@section('page-heading','Products')
@section('content')
<div class="row">
    <div class="col-md-12">
        <form method="POST" action="{{ url('/admin/products/update')}}" enctype="multipart/form-data">
            @csrf
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-8 d-flex align-items-center">
                            <h2 class="text-uppercase text-dark font-weight-bold custom_h_size">
                                Update Product's Information
                            </h2>
                        </div>
                        <div class="col-md-4 d-flex justify-content-end">
                            <a href="{{ url('/admin/products') }}" class="btn btn-sm btn-secondary font-weight-bold text-uppercase">
                                <i class="fas fa-globe"></i>&nbsp; 
                                All Products Information 
                            </a>
                        </div>
                    </div>
                </div>
                @if (Session::has('update_error'))
                    <script>
                        swal({title: "Opps !",text: "{{ Session::get('update_error') }}",
                            icon: "error",timer: 4000
                            });
                    </script>
                @endif
                <div class="card-body" style="background-color: rgba(30, 39, 46, 0.05)">

                    <input type="hidden" name="id" value="{{ $data['id'] }}">
                    {{-- <input type="hidden" name="product_code" value="{{ $data['product_code'] }}"> --}}
                    <input type="hidden" name="product_slug" value="{{ $data['product_slug'] }}">

                    <div class="row">
                        <div class="col-md-6 border">
                            <div class="form-group row border">
                                <label for="product_name" class="col-sm-2 col-form-label custom_form_label">
                                    Product Name :<span class="req_star">*</span>
                                </label>
                                <div class="col-sm-10">
                                  <input type="text" id="product_name" value="{{$data['product_name']}}" class="form-control custom_form_control" name="product_name" placeholder="Product Name">
                                    @error('product_name')
                                        <span class="alert alert-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row border">
                                <label for="quantity" class="col-sm-2 col-form-label custom_form_label">
                                    Quantity :<span class="req_star">*</span>
                                </label>
                                <div class="col-sm-10">
                                  <input type="number" id="quantity" value="{{$data['quantity']}}" class="form-control custom_form_control" name="quantity" value="{{ old('quantity') }}">
                                    @error('quantity')
                                        <span class="alert alert-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row border">
                                <label for="alert_stock" class="col-sm-2 col-form-label custom_form_label">
                                    Alert Stock :<span class="req_star">*</span>
                                </label>
                                <div class="col-sm-10">
                                  <input type="number" id="alert_stock" value="{{$data['alert_stock']}}" class="form-control custom_form_control" name="alert_stock" value="{{ old('alert_stock') }}">
                                    @error('alert_stock')
                                        <span class="alert alert-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>


                        <div class="col-md-6 border">
                            <div class="form-group row border">
                                <label for="generic_name" class="col-sm-2 col-form-label custom_form_label">
                                    Generic Name :<span class="req_star">*</span>
                                </label>
                                <div class="col-sm-10">
                                  <input type="text" id="generic_name" value="{{$data['generic_name']}}" class="form-control custom_form_control" name="generic_name" placeholder="Generic Name">
                                    @error('generic_name')
                                        <span class="alert alert-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row border">
                                <label for="packing" class="col-sm-2 col-form-label custom_form_label">
                                    Packing :<span class="req_star">*</span>
                                </label>
                                <div class="col-sm-10">
                                  <input type="text" id="packing" class="form-control custom_form_control" name="packing" value="{{$data['packing']}}" placeholder="3 X 10">
                                    @error('packing')
                                        <span class="alert alert-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row border">
                                <label for="product_img" class="col-sm-2 col-form-label custom_form_label">
                                    Product Image :<span class="req_star">*</span>
                                </label>
                                <div class="col-sm-10">
                                  {{-- <input type="file" id="product_img" class="form-control custom_form_control" name="product_img" value="{{ old('product_img') }}">
                                  @error('product_img')
                                        <span class="alert alert-danger">{{ $message }}</span>
                                 @enderror
                                 
                                 <img src="{{ asset('uploads/products/'.$data['product_img']) }}" height="auto" width="200px" alt=""> --}}
                                 <input type="file" class="form-control custom_form_control mb-2"  name="product_img" onchange="previewFile(this);">
                                 <img id="previewImg" class=" custom_form_control " src="{{ asset('uploads/products/'.$data['product_img']) }}" alt="Photo" width="150px">
                                 @error('product_img')
                                         <span class="alert alert-danger">{{ $message }}</span>
                                 @enderror
                                
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-group row border border">
                        <label for="specification" class="col-sm-2 col-form-label custom_form_label">
                            Specification :<span class="req_star">*</span>
                        </label>
                        <div class="col-sm-10">
                          <textarea name="specification" id="specification" cols="10" rows="3" class="form-control custom_textarea custom_form_control" placeholder="Specification">
                            {{ $data['specification'] }}
                          </textarea>
                          @error('specification')
                                <span class="alert alert-danger">{{ $message }}</span>
                         @enderror
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