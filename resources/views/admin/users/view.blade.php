@extends('layouts.admin')
@section('page_title','View Users')
@section('page-heading','Users')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-8 d-flex align-items-center">
                        <h2 class="text-uppercase text-dark font-weight-bold custom_h_size">
                            View User Information
                        </h2>
                    </div>
                    <div class="col-md-4 d-flex justify-content-end">
                        <a href="{{ url('/admin/users/edit/'.$data->slug) }}" class="btn btn-sm btn-secondary font-weight-bold text-uppercase">
                            <i class="fas fa-user-edit"></i>&nbsp 
                            Update User Account
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
                    <div class="view_img_container col-md-4 border d-flex justify-content-center align-items-center p-2">
                        {{-- <img src="{{asset('/uploads/customers/'.$data['0']->photo)}}" alt="..." class="container-fluid avatar-img rounded profile_img"> --}}
                    
                        @if ($data->photo != '')
                        <img src="{{ asset('uploads/users/'.$data->photo) }}" alt="Photo" class="container-fluid avatar-img rounded profile_img">
                        @else
                            <img src="{{ asset('uploads/users/avarter.jpg') }}" alt="Photo" class="container-fluid avatar-img rounded profile_img" >
                        @endif
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
            
            $user_id = $data->id;
            $daily_report = App\Models\OrderMaster::with(['orderDetails.product', 'customer', 'creator', 'warehouse'])
                            ->where(function ($query) use ($user_id) {
                                $query->where('customer_id', $user_id)
                                    ->orWhere('user_id', $user_id);
                            })
                            ->orderBy('id', 'DESC')
                            ->get();
                            $total_qty = App\Models\OrderMaster::where(function ($query) use ($user_id) {
                                $query->where('customer_id', $user_id)
                                    ->orWhere('user_id', $user_id);
                            })->sum('num_of_item');

        @endphp
        <div class="card mt-4">
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
                    <table id="basic-datatables" class="display table table-striped table-hover" >
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
                                                    Delivered
                                                </span>
                                            @else
                                                <span class="badge badge-danger">
                                                    Pending
                                                </span>
                                            @endif
                                        </td>
                                        <td>{{$order->order_date}}</td>
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
        $('#basic-datatables').DataTable({
            ordering: false,
            responsive: true,
            autoWidth: false,
        });
    });
    </script>
@endsection