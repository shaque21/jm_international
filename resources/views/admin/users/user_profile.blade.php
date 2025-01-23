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
                                            @elseif(Auth::user()->role_id == 2)
                                                Employee
                                            @else
                                                Customer
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
                                    @elseif($data->role_id == 2)
                                        <span class="badge badge-secondary">
                                            Employee
                                        </span>
                                    @else
                                        <span class="badge badge-warning">
                                            Customer
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

        @php
            // use Carbon\Carbon;
            // $today = Carbon::now()->today();
            // $date = $today->format('Y-m-d');
            $user_id = Auth::user()->id;
            $daily_report = App\Models\OrderMaster::with(['orderDetails.product', 'customer', 'creator', 'warehouse'])
                            // ->where('date', $date)
                            ->where('user_id',$user_id)
                            ->orderBy('id', 'DESC')
                            ->get();
            $total_qty = App\Models\OrderMaster::where('user_id',$user_id)->sum('num_of_item');
        @endphp

        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-6">
                        <p class="text-uppercase font-weight-bold custom_h_size">
                            My Orders : 
                        </p>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="basic-datatables-report" class="display table table-striped table-hover" >
                        <thead class="thead-dark">
                            <tr>
                                <th>#</th>
                                <th>Product Name</th>
                                <th>Qty</th>
                                <th>Ordered By</th>
                                <th>Delivered By</th>
                                {{-- <th>Delivered From</th> --}}
                                <th>Order Status</th>
                                <th>Order Date</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>#</th>
                                <th>Product Name</th>
                                <th>Qty</th>
                                <th>Ordered By</th>
                                <th>Delivered By</th>
                                {{-- <th>Delivered From</th> --}}
                                <th>Order Status</th>
                                <th>Order Date</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach ($daily_report as $key => $order)
                                @foreach ($order->orderDetails as $orderDetail)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $orderDetail->product->product_name ?? 'N/A' }}</td>
                                        <td>{{ $orderDetail->delivered_qty ?? 0 }}</td>
                                        <td>{{ $order->customer->name ?? 'N/A' }}</td>
                                        <td>{{ $order->creator->name ?? 'N/A' }}</td>
                                        {{-- <td>
                                            @if ($order->warehouse_id)
                                                {{ $order->warehouse->name ?? 'N/A' }}
                                            @elseif ($order->depo_id)
                                                {{ $order->depo->depo_name ?? 'N/A' }}
                                            @else
                                                N/A
                                            @endif
                                        </td> --}}
                                        
                                        <td>
                                            @if ($order->order_status == 1)
                                                <span class="badge badge-success">
                                                    Approved
                                                </span>
                                            @else
                                                <span class="badge badge-danger">
                                                    Pending
                                                </span>
                                            @endif
                                        </td>
                                        <td>{{$order->date}}</td>
                                    </tr>
                                @endforeach
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer">
                <h1 class="text-dark">TOTAL QUANTITY : {{ $total_qty }} <small>( PCS )</small></h1>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
    <script>
        $(document).ready(function(){
            $('#basic-datatables-report').DataTable({
                ordering: false,
                responsive: true,
                autoWidth: false,
			});
        });
        
    </script>
@endsection