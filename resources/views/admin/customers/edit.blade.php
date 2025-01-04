@extends('layouts.admin')
@section('page_title','Edit Customers')
@section('page-heading','Customers')
@section('content')
<div class="row">
    <div class="col-md-12">
        <form method="POST" action="{{ url('/admin/customers/update')}}" enctype="multipart/form-data">
            @csrf 
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-8 d-flex align-items-center">
                            <h2 class="text-uppercase text-dark font-weight-bold custom_h_size">
                                Update Customer's Information
                            </h2>
                        </div>
                        <div class="col-md-4 d-flex justify-content-end">
                            <a href="{{ url('/admin/customers') }}" class="btn btn-sm btn-secondary font-weight-bold text-uppercase">
                                <i class="fas fa-globe"></i>&nbsp; 
                                All Customers Information 
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
                    <input type="hidden" name="slug" value="{{ $data['slug'] }}">

                    <div class="row">
                        <div class="col-md-6 border">
                            <div class="form-group row border">
                                <label for="name" class="col-sm-2 col-form-label custom_form_label">
                                    Name :<span class="req_star">*</span>
                                </label>
                                <div class="col-sm-10">
                                  <input type="text" id="name" class="form-control custom_form_control" name="name" value="{{ $data['name']}}">
                                    @error('name')
                                        <span class="alert alert-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row border">
                                <label for="mobile" class="col-sm-2 col-form-label custom_form_label">
                                    Mobile :<span class="req_star">*</span>
                                </label>
                                <div class="col-sm-10">
                                  <input type="text" id="mobile" class="form-control custom_form_control" name="mobile" value="{{ $data['mobile']}}">
                                    @error('mobile')
                                        <span class="alert alert-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            {{-- <div class="form-group row"> 
                                <label for="password" class="col-sm-2 col-form-label custom_form_label">
                                    Password :<span class="req_star">*</span>
                                </label>
                                <div class="col-sm-10">
                                  <input type="password" id="password" class="form-control custom_form_control" name="password" value="{{ $data['password']}}">
                                    @error('password')
                                        <span class="alert alert-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div> --}}

                            <div class="form-group row border">
                                <label for="address" class="col-sm-2 col-form-label custom_form_label">
                                    Address :<span class="req_star">*</span>
                                </label>
                                <div class="col-sm-10">
                                  <textarea class="form-control custom_form_control" name="address" id="address" cols="6" rows="3"  placeholder="Address">
                                    {{ $data['address'] }}
                                  </textarea>
                                  @error('address')
                                        <span class="alert alert-danger">{{ $message }}</span>
                                 @enderror
                                </div>
                            </div>
                        </div>


                        <div class="col-md-6 border">
                            <div class="form-group row border">
                                <label for="email" class="col-sm-2 col-form-label custom_form_label">
                                    Email :<span class="req_star">*</span>
                                </label>
                                <div class="col-sm-10">
                                  <input type="email" id="email" class="form-control custom_form_control" name="email" value="{{ $data['email']}}">
                                    @error('email')
                                        <span class="alert alert-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row border">
                                <label for="shop_name" class="col-sm-2 col-form-label custom_form_label">
                                    Shop_name :<span class="req_star">*</span>
                                </label>
                                <div class="col-sm-10">
                                  <input type="text" id="shop_name" class="form-control custom_form_control" name="shop_name" value="{{ $data['shop_name']}}">
                                    @error('shop_name')
                                        <span class="alert alert-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row border">
                                <label for="photo" class="col-sm-2 col-form-label custom_form_label">
                                    Image :<span class="req_star">*</span>
                                </label>
                                <div class="col-sm-10">
                                  {{-- <input type="file" id="photo" class="form-control custom_form_control" name="photo" value="{{ old('photo') }}">
                                  @error('photo')
                                        <span class="alert alert-danger">{{ $message }}</span>
                                 @enderror --}}

                                    <input type="file" class="form-control custom_form_control mb-2"  name="photo" onchange="previewFile(this);">
                                    <img id="previewImg" class=" custom_form_control " src="{{ asset('uploads/customers/'.$data['photo']) }}" alt="Photo" width="150px">
                                    @error('photo')
                                            <span class="alert alert-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                
                            </div>
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