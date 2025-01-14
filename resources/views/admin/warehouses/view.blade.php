@extends('layouts.admin')
@section('page_title','View Warehouses Information')
@section('page-heading','Warehouses')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-8 d-flex align-items-center">
                        <h2 class="text-uppercase text-dark font-weight-bold custom_h_size">
                            View Warehouses Information
                        </h2>
                    </div>
                    <div class="col-md-4 d-flex justify-content-end">
                        <a href="{{ url('/admin/warehouses/edit/'.$data['0']->warehouse_slug) }}" class="btn btn-secondary btn-sm font-weight-bold text-uppercase">
                            <i class="fas fa-wrench"></i>&nbsp 
                            Update Warehouses Information
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

                <div class="row border">
                    <div class="view_img_container col-md-4 border d-flex justify-content-center align-items-center">
                        {{-- <img src="{{asset('/uploads/products/'.$data['0']->product_img)}}" alt="..." class="container-fluid avatar-img rounded profile_img"> --}}
                    </div>
                    <div class="col-md-8 border d-flex justify-content-center align-items-center">
                        <table class="mt-4 table table-bordered table-hover table-striped custom_view_table">
                            <tr>
                                <td>Warehouse Name</td>
                                <td>:</td>
                                <td>{{ $data['0']->name }}</td>
                            </tr>
                            
                            <tr>
                                <td>Create Time</td>
                                <td>:</td>
                                <td>{{ $data['0']->created_at->format('d M Y | h:i A') }}</td>
                            </tr>
                            @if (isset($data['0']->updated_at))
                                <tr>
                                    <td>Updated Time</td>
                                    <td>:</td>
                                    <td>{{ $data['0']->updated_at->format('d M Y | h:i A') }}</td>
                                </tr>
                            @endif
                        </table>
                    </div>
                </div>
                
            </div>
            {{-- <div class="card-footer">
                <a href="#" class="btn btn-primary btn-sm text-uppercase font-weight-bold">Print</a>
                <a href="#" class="btn btn-warning btn-sm text-uppercase font-weight-bold">PDF</a>
                <a href="#" class="btn btn-success btn-sm text-uppercase font-weight-bold">Excel</a>
            </div> --}}
        </div>
    </div>
</div>
@endsection