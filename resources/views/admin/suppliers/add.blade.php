@extends('layouts.admin')
@section('page_title','Add New Suppliers')
@section('page-heading','Suppliers')
@section('content')
<div class="row"> 
    <div class="col-md-12">
        <form method="POST" id="addSupplierForm" action="{{ url('/admin/suppliers/submit') }}" enctype="multipart/form-data">
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
                                Add Supplier Information
                            </h2> 
                        </div>
                        <div class="col-md-4 d-flex justify-content-end">
                            <a href="{{ url('/admin/suppliers') }}" class="btn btn-sm btn-secondary font-weight-bold text-uppercase">
                                <i class="fas fa-globe"></i>&nbsp; 
                                All Available Suppliers 
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body" style="background-color: rgba(30, 39, 46, 0.05)">

                    <div class="row">
                        <div class="col-md-6 border">
                            <div class="form-group row border">
                                <label for="sup_name" class="col-sm-2 col-form-label custom_form_label">
                                    Supplier Name :<span class="req_star">*</span>
                                </label>
                                <div class="col-sm-10">
                                  <input type="text" id="sup_name" class="form-control custom_form_control" name="sup_name" placeholder="Supplier Name">
                                    @error('sup_name')
                                        <span class="alert alert-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row border">
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
                            <div class="form-group row border">
                                <label for="company_name" class="col-sm-2 col-form-label custom_form_label">
                                    Company Name:<span class="req_star">*</span>
                                </label>
                                <div class="col-sm-10">
                                  <input type="text" id="company_name" class="form-control custom_form_control" name="company_name" placeholder="Company Name">
                                    @error('company_name')
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
                                  <input type="email" id="email" class="form-control custom_form_control" name="email" placeholder="Email Address">
                                    @error('email')
                                        <span class="alert alert-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="form-group row border">
                                <label for="sup_photo" class="col-sm-2 col-form-label custom_form_label">
                                    Image :<span class="req_star">*</span>
                                </label>
                                <div class="col-sm-10">
                                  <input type="file" id="photo" class="form-control custom_form_control" name="sup_photo" value="{{ old('photo') }}" onchange="previewFile(this);">
                                  <img id="previewImg" src="{{ asset('uploads/users/avarter.jpg') }}" class="mt-2 border custom_form_control" alt="Photo" width="150px">
                                  @error('sup_photo')
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