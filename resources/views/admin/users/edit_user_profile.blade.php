@extends('layouts.admin')
@section('page_title','Edit Profile')
@section('page-heading','Profile')
@section('content')
<div class="row">
    <div class="col-md-12">
        <form method="POST" action="{{ url('/admin/profile/profile_update')}}" enctype="multipart/form-data">
            @csrf
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-8 d-flex align-items-center">
                            <h2 class="text-uppercase text-dark font-weight-bold custom_h_size">
                                Update my Information
                            </h2>
                        </div>
                        <div class="col-md-4 d-flex justify-content-end">
                            <a href="{{ url('/admin/profile/user_profile/'.$users->slug) }}" class="btn btn-sm btn-secondary font-weight-bold text-uppercase">
                                <i class="fas fa-user"></i>&nbsp; 
                                My Account 
                            </a>
                        </div>
                    </div>
                </div>
                
                @if (Session::has('update_error'))
                    <script>
                        swal({title: "Opps!",text: "Income Category is not Updated!",
                            icon: "error",timer: 4000
                            });
                    </script>
                @endif
                <div class="card-body" style="background-color: rgba(30, 39, 46, 0.05)">

                    <div class="row">
                        <input type="hidden" name="id" id="id" value="{{ $users->id }}">
                        <input type="hidden" name="slug" id="slug" value="{{ $users->slug }}">
                        <div class="col-md-6 border">
                            <div class="form-group row border">
                                <label for="name" class="col-sm-2 col-form-label custom_form_label">
                                    Name :<span class="req_star">*</span>
                                </label>
                                <div class="col-sm-10">
                                  <input type="text" id="name" class="form-control custom_form_control" name="name" value="{{$users->name}}">
                                    @error('name')
                                        <span class="alert alert-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row border">
                                <label for="email" class="col-sm-2 col-form-label custom_form_label">
                                    Email :<span class="req_star">*</span>
                                </label>
                                <div class="col-sm-10">
                                  <input type="email" id="email" class="form-control custom_form_control" name="email" value="{{$users->email}}">
                                    @error('email')
                                        <span class="alert alert-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row border">
                                <label for="mobile" class="col-sm-2 col-form-label custom_form_label">
                                    Mobile :<span class="req_star">*</span>
                                </label>
                                <div class="col-sm-10">
                                  <input type="text" id="mobile" class="form-control custom_form_control" name="mobile" value="{{$users->mobile}}">
                                    @error('mobile')
                                        <span class="alert alert-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row border">
                                <label for="role_id" class="col-sm-2 col-form-label custom_form_label">
                                    User Role :<span class="req_star">*</span> 
                                </label>
                                <div class="col-sm-10">
                                    <select name="role_id" id="role_id" class="form-control custom_form_control">
                                        <option value="" selected disabled>Select Role</option>
                                        <option value="1" {{ $users->role_id == 1 ? 'selected' : '' }}>Admin</option>
                                        <option value="2" {{ $users->role_id == 2 ? 'selected' : '' }}>Employee</option>
                                        <option value="3" {{ $users->role_id == 3 ? 'selected' : '' }}>Customer</option>
                                    </select>
                                    
                                </div>
                            </div>
                            
                        </div>


                        <div class="col-md-6 border">
                            {{-- <div class="form-group row border">
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
                            <div class="form-group row border">
                                <label for="password_confirmation" class="col-sm-2 col-form-label custom_form_label">
                                    Confirm Pass:<span class="req_star">*</span>
                                </label>
                                <div class="col-sm-10">
                                  <input type="password" id="password_confirmation" class="form-control custom_form_control" name="password_confirmation" placeholder="Confirm Password">
                                    @error('password_confirmation')
                                        <span class="alert alert-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div> --}}
                            
                            <div class="form-group row border">
                                <label for="photo" class="col-sm-2 col-form-label custom_form_label">
                                    Image :<span class="req_star">*</span>
                                </label>
                                <div class="col-sm-10">
                                  {{-- <input type="file" id="photo" class="form-control custom_form_control" name="photo" value="{{ old('photo') }}" onchange="previewFile(this);">
                                  <img id="previewImg" src="{{ asset('uploads/users/avarter.jpg') }}" alt="Photo" width="150px"> --}}
                                    <input type="file" class="form-control custom_form_control mb-2"  name="photo" onchange="previewFile(this);">
                                    <img id="previewImg" class=" custom_form_control " src="{{ asset('uploads/users/'.$users->photo) }}" alt="Photo" width="150px">
                                    @error('photo')
                                            <span class="alert alert-danger">{{ $message }}</span>
                                    @enderror
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