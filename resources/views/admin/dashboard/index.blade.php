@extends('layouts.admin')
@section('page_title','Admin Dashboard')
@section('page-heading','Dashboard')
@section('content')
@if(Auth::user()->role_id == 1)
    <div class="row">
        <div class="col-sm-6 col-md-3">
            <div class="card card-stats card-round">
                <div class="card-body ">
                    <div class="row align-items-center">
                        <div class="col-icon">
                            <div class="icon-big text-center icon-primary bubble-shadow-small">
                                <i class="fas fa-users"></i>
                            </div>
                        </div>
                        
                        <div class="col col-stats ml-3 ml-sm-0">
                            <div class="numbers">
                                @php
                                    $totalUsers = App\Models\User::where('status',1)->count();
                                @endphp
                                <p class="card-category">Users</p>
                                <h4 class="card-title">
                                    @if ($totalUsers<10)
                                        0{{ $totalUsers }}
                                    @else
                                        {{ $totalUsers }}
                                    @endif
                                </h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-md-3">
            <div class="card card-stats card-round">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-icon">
                            <div class="icon-big text-center icon-info bubble-shadow-small">
                                <i class="fas fa-box"></i>
                            </div>
                        </div>
                        <div class="col col-stats ml-3 ml-sm-0">
                            <div class="numbers">
                                <p class="card-category">Products</p>
                                    <h4 class="card-title">
                                        @php
                                            $allProducts= App\Models\Product::where('product_status',1)
                                            ->count();
                                        @endphp
                                        @if ($allProducts < 10)
                                            0{{ $allProducts }}
                                        @else
                                            {{ $allProducts }}
                                        @endif
                                </h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-md-3">
            <div class="card card-stats card-round">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-icon">
                            <div class="icon-big text-center icon-success bubble-shadow-small">
                                <i class="far fa-chart-bar"></i>
                            </div>
                        </div>
                        @php
                            $total_qty = App\Models\OrderMaster::sum('num_of_item');
                        @endphp
                        <div class="col col-stats ml-3 ml-sm-0">
                            <div class="numbers">
                                <p class="card-category">Sales</p>
                                <h4 class="card-title"> {{ $total_qty }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-md-3">
            <div class="card card-stats card-round">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-icon">
                            <div class="icon-big text-center icon-secondary bubble-shadow-small">
                                <i class="far fa-check-circle"></i>
                            </div>
                        </div>
                    
                        <div class="col col-stats ml-3 ml-sm-0">
                            <div class="numbers">
                                <p class="card-category">Order</p>
                                <h4 class="card-title">
                                    @php
                                        $allOrders= App\Models\OrderMaster::where('order_status',1)
                                        ->count();
                                    @endphp
                                    @if ($allOrders < 10)
                                        0{{ $allOrders }}
                                    @else
                                        {{ $allOrders }}
                                    @endif
                                </h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif

{{-- Everyday Reports --}}
<div class="row">
    <div class="col-md-12">
        @php
            use Carbon\Carbon;
            $today = Carbon::now()->today();
            $date = $today->format('Y-m-d');
            $daily_report = App\Models\OrderMaster::with(['orderDetails.product', 'customer', 'creator', 'warehouse'])
                            ->where('date', $date)
                            ->orderBy('id', 'DESC')
                            ->get();
            $total_qty = App\Models\OrderMaster::where('date', $date)->sum('num_of_item');
        @endphp
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-6">
                        <p class="text-uppercase font-weight-bold custom_h_size">
                            All Order Details Of (Today) : 
                           @php
                               if(isset($date)){
                                   echo $date;
                                   $url='/admin/reports/daily/download/'.$date;
                               }
                               else if(isset($month) && isset($year)){
                                   echo $month.'-'.$year;
                                   $url='/admin/reports/monthly/download/'.$month.'/'.$year;
                               }else{
                                   echo $year;
                                   $url='/admin/reports/yearly/download/'.$year;
                               }
                           @endphp 
                        </p>
                    </div>
                    <div class="col-md-6 text-right">
                        <a href="{{ url('/admin/reports') }}" class="btn btn-sm btn-dark text-uppercase">
                            <i class="fas fa-file-archive"></i>&nbsp;
                             Other Reports
                        </a>
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
                                <th>Delivered From</th>
                                <th>Order Status</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>#</th>
                                <th>Product Name</th>
                                <th>Qty</th>
                                <th>Ordered By</th>
                                <th>Delivered By</th>
                                <th>Delivered From</th>
                                <th>Order Status</th>
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
                                        <td>
                                            @if ($order->warehouse_id)
                                                {{ $order->warehouse->name ?? 'N/A' }}
                                            @elseif ($order->depo_id)
                                                {{ $order->depo->depo_name ?? 'N/A' }}
                                            @else
                                                N/A
                                            @endif
                                        </td>
                                        
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