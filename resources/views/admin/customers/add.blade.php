@extends('layouts.admin')
@section('page_title','Add New Customer')
@section('page-heading','Customerss')
@section('content')
<div class="row">
    <div class="col-md-12">
        <form method="POST" id="addCustomerForm" action="{{ url('/admin/customers/submit') }}" enctype="multipart/form-data">
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
                                Add Customer Information
                            </h2>
                        </div>
                        <div class="col-md-4 d-flex justify-content-end">
                            <a href="{{ url('/admin/customers') }}" class="btn btn-sm btn-secondary font-weight-bold text-uppercase">
                                <i class="fas fa-globe"></i>&nbsp; 
                                All Available Customers 
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body" style="background-color: rgba(30, 39, 46, 0.05)">

                    <div class="row">
                        <div class="col-md-6 border">
                            <div class="form-group row">
                                <label for="name" class="col-sm-2 col-form-label custom_form_label">
                                    Name :<span class="req_star">*</span>
                                </label>
                                <div class="col-sm-10">
                                  <input type="text" id="name" class="form-control custom_form_control" name="name" placeholder="Customer Name">
                                    @error('name')
                                        <span class="alert alert-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="mobile" class="col-sm-2 col-form-label custom_form_label">
                                    Mobile :<span class="req_star">*</span>
                                </label>
                                <div class="col-sm-10">
                                  <input type="text" id="mobile" class="form-control custom_form_control" name="mobile" placeholder="Mobile Number">
                                    @error('mobile')
                                        <span class="alert alert-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="password" class="col-sm-2 col-form-label custom_form_label">
                                    Password :<span class="req_star">*</span>
                                </label>
                                <div class="col-sm-10">
                                  <input type="password" id="password" class="form-control custom_form_control" name="password" placeholder="Password">
                                    @error('password')
                                        <span class="alert alert-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>


                        <div class="col-md-6 border">
                            <div class="form-group row">
                                <label for="email" class="col-sm-2 col-form-label custom_form_label">
                                    Email :<span class="req_star">*</span>
                                </label>
                                <div class="col-sm-10">
                                  <input type="email" id="email" class="form-control custom_form_control" name="email" placeholder="Email Address">
                                    @error('email')
                                        <span class="alert alert-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="shop_name" class="col-sm-2 col-form-label custom_form_label">
                                    Shop_name :<span class="req_star">*</span>
                                </label>
                                <div class="col-sm-10">
                                  <input type="text" id="shop_name" class="form-control custom_form_control" name="shop_name" placeholder="Shop Name">
                                    @error('shop_name')
                                        <span class="alert alert-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="photo" class="col-sm-2 col-form-label custom_form_label">
                                    Image :<span class="req_star">*</span>
                                </label>
                                <div class="col-sm-10">
                                  <input type="file" id="photo" class="form-control custom_form_control" name="photo" value="{{ old('photo') }}">
                                  @error('photo')
                                        <span class="alert alert-danger">{{ $message }}</span>
                                 @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-group row border">
                        <label for="address" class="col-sm-2 col-form-label custom_form_label">
                            Address :<span class="req_star">*</span>
                        </label>
                        <div class="col-sm-10">
                          <textarea name="address" id="address" cols="10" rows="3" class="form-control custom_textarea custom_form_control" placeholder="Address"></textarea>
                          @error('address')
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
