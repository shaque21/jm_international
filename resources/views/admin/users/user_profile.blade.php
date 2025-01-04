@extends('layouts.admin')
@section('page_title','User Profile')
@section('page-heading','My Profile')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-8 d-flex align-items-center">
                        <h2 class="text-uppercase text-dark font-weight-bold custom_h_size">
                            My Informations
                        </h2>
                    </div>
                    <div class="col-md-4 d-flex justify-content-end">
                        <a href="{{ url('/admin/profile/edit_user_password/'.$data->slug) }}" class="btn btn-secondary btn-sm font-weight-bold text-uppercase">
                            <i class="fas fa-key"></i>&nbsp 
                            Update Password
                        </a>
                        <a href="{{ url('/admin/profile/edit_user_profile/'.$data->slug) }}" class="ml-2 btn btn-dark btn-sm font-weight-bold text-uppercase">
                            <i class="fas fa-user-edit"></i>&nbsp 
                            Update My Account
                        </a>
                    </div>
                </div>
            </div>
            @if (Session::has('update_success'))
                <script>
                    swal({title: "Well Done!",text: "{{ Session::get('update_success') }}",
                        icon: "success",timer: 4000
                        });
                </script>
            @endif
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <div class="card card-profile card-secondary">
                            <div class="card-header" style="background-image: url('{{ asset('contents/admin/assets/img/blogpost.jpg') }}')">
                                <div class="profile-picture">
                                    <div class="avatar avatar-xl">
                                        @if(Auth::user()->photo!='')
                                            <img src="{{asset('uploads/users/'.Auth::user()->photo)}}" alt="photo" class="avatar-img rounded-circle"/>
                                        @else
                                            <img src="{{asset('uploads/avatar.jpg')}}" alt="photo" class="avatar-img rounded-circle"/>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="user-profile text-center">
                                    <div class="job">
                                        <span class="badge badge-secondary px-4">
                                            @if (Auth::user()->role_id == 1)
                                                Admin
                                            @else
                                                Employee
                                            @endif
                                            {{-- {{ Auth::user()->user_role->role_name }} --}}
                                        </span>
                                        <div class="name">{{ Auth::user()->name }}</div>
                                    </div>
                                    <div class="view-profile">
                                        <a href="{{ url('/admin/profile/edit_user_profile/'.$data->slug) }}" class="btn btn-sm btn-secondary btn-block">Update My Account</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8 border d-flex justify-content-center align-items-center">
                        <table class="mt-4 table table-bordered table-hover table-striped custom_view_table">
                            <tr>
                                <td>User Name</td>
                                <td>:</td>
                                <td>{{ $data->name }}</td>
                            </tr>
                            {{-- <tr>
                                <td>Shop Name</td>
                                <td>:</td>
                                <td>{{ $data['0']->shop_name }}</td>
                            </tr> --}}
                            <tr>
                                <td>Mobile</td>
                                <td>:</td>
                                <td>{{ $data->mobile }}</td>
                            </tr>
                            <tr>
                                <td>Email</td>
                                <td>:</td>
                                <td>{{ $data->email }}</td>
                            </tr>
                            <tr>
                                <td>Role</td>
                                <td>:</td>
                                <td>
                                    @if ($data->role_id == 1)
                                        <span class="badge badge-success">
                                            Admin
                                        </span>
                                    @else
                                        <span class="badge badge-secondary">
                                            Employee
                                        </span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td>Create Time</td>
                                <td>:</td>
                                <td>{{ $data->created_at->format('d M Y | h:i A') }}</td>
                            </tr>
                            @if (isset($data->updated_at))
                                <tr>
                                    <td>Updated Time</td>
                                    <td>:</td>
                                    <td>{{ $data->updated_at->format('d M Y | h:i A') }}</td>
                                </tr>
                            @endif
                            
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection