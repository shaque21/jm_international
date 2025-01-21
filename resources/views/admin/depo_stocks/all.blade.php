@extends('layouts.admin')
@section('page_title','All Depo Stocks')
@section('page-heading','Depo Stocks')
@section('content')
<div class="row">
    <div class="col-md-12">

        @if (Session::has('success'))
                <script>
                    swal({title: "Well Done!",text: "{{ Session::get('success') }}",
                        icon: "success",timer: 4000
                        });
                </script>
        @endif
        @if (Session::has('error'))
            <script>
                swal({title: "Well Done!",text: "{{ Session::get('error') }}",
                    icon: "error",timer: 4000
                    });
            </script>
        @endif
        @if (Session::has('delete_success'))
            <script>
                swal({title: "Well Done !",text: "{{ Session::get('delete_success') }}",
                    icon: "success",timer: 4000
                    });
            </script> 
        @endif
        @if (Session::has('delete_error'))
            <script>
                swal({title: "Opps !",text: "{{ Session::get('delete_error') }}",
                    icon: "error",timer: 4000
                    });
            </script>
        @endif

        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-8 d-flex align-items-center">
                        <h2 class="text-uppercase text-dark font-weight-bold custom_h_size">
                            @php
                                $time = Carbon\Carbon::now()->format('d M Y | h:i  A');
                            @endphp
                            Total Product quantity in Depo 
                            <span style="color:rgba(0, 128, 0, 0.396); font-size:1.5rem; font-style:italic;">
                                ({{$time}})
                            </span>
                        </h2>
                    </div>
                </div>
            </div>
            

            
            <div class="card-body">
                <div class="table-responsive-sm">
                    <table id="basic-datatables" class="table table-bordered table-striped table-hover">
                        <thead class="">
                            <tr>
                                <th>#</th>
                                <th>Depo Name</th>
                                <th>Product Name</th>
                                <th>Total Stocks</th>
                                <th>Alert Stock</th>
                                <th>Last Updated</th>
                                {{-- <th>Alert Stock</th> --}}
                                {{-- <th>Status</th> --}}
                                {{-- <th class="text-center">Action</th> --}}
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($total_stocks as $key=>$item)
                                <tr class="text-center">
                                    <td>{{ $key+1 }}</td>
                                    <td>{{ $item->depo->depo_name }}</td>
                                    <td>{{ $item->product->product_name }}</td>
                                    <td>{{ $item->total_stock }}</td>
                                    <td>
                                        @if ($item->alert_stock >= $item->total_stock)
                                            <span class="badge badge-danger">
                                                Low Stock ( {{ $item->total_stock }} ) > {{ $item->alert_stock }}
                                            </span>
                                        @else
                                        <span class="badge badge-success">
                                            @if ($item->alert_stock < 10)
                                            0{{ $item->alert_stock }}
                                            @else
                                            {{ $item->alert_stock }}
                                            @endif
                                            
                                        </span>
                                        @endif
                                    </td>
                                    <td>{{ $item->updated_at->format('d M Y | h:s A' ) }}</td>
                                    {{-- <td class="text-center">
                                        <a class="text-dark mx-1" href="{{ url('/admin/warehouse_stocks/view/'.$item->wr_slug) }}" data-toggle="tooltip" data-placement="top" title="View Task"><i class="fas fa-eye"></i></a>
                                        <a class="text-info mx-1" href="{{ url('/admin/warehouse_stocks/edit/'.$item->wr_slug) }}"><i class="fas fa-edit" data-toggle="tooltip" data-placement="top" title="Edit Task"></i></a>
                                        <a class="text-danger mx-1 delete-confirm" href="{{ url('/admin/warehouse_stocks/soft-delete/'.$item->wr_slug) }}"><i class="fas fa-trash" data-toggle="tooltip" data-placement="top" title="Remove Task"></i></a>
                                    </td> --}}
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-8 d-flex align-items-center">
                        <h2 class="text-uppercase text-dark font-weight-bold custom_h_size">
                            All Depo Stock's Details with Date 
                        </h2>
                    </div>
                    <div class="col-md-4 d-flex justify-content-end">
                        <a href="{{ url('/admin/depo_stocks/create') }}" class="btn btn-secondary btn-sm font-weight-bold text-uppercase">
                            <i class="fas fa-cart-plus"></i>&nbsp 
                            Add New Depo Stock
                        </a>
                    </div>
                </div>
            </div>
            

            
            <div class="card-body">
                <div class="table-responsive-sm">
                    <table id="basic-datatables-all" class="table table-bordered table-striped table-hover">
                        <thead class="">
                            <tr>
                                <th>#</th>
                                <th>Depo Name</th>
                                <th>Warehouse Name</th>
                                <th>Product Name</th>
                                <th>Deliverd By</th>
                                <th>Received By</th>
                                <th>Qty</th>
                                <th>Date and Time</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($stocks as $key=>$item)
                                <tr class="text-center">
                                    <td>{{ $key+1 }}</td>
                                    <td>{{ $item->depo->depo_name }}</td>
                                    <td>{{ $item->warehouse->name }}</td>
                                    <td>{{ $item->product->product_name }}</td>
                                    <td>{{ $item->user->name }}</td>
                                    <td>{{ $item->employee->name }}</td>
                                    <td>{{ $item->quantity }}</td>
                                    <td>{{ $item->created_at->format('d M Y | h:s A' ) }}</td>
                                    <td class="text-center">
                                        <a class="text-dark mx-1" href="{{ url('/admin/depo_stocks/view/'.$item->ds_slug) }}" data-toggle="tooltip" data-placement="top" title="View Task"><i class="fas fa-eye"></i></a>
                                        <a class="text-info mx-1" href="{{ url('/admin/depo_stocks/edit/'.$item->ds_slug) }}"><i class="fas fa-edit" data-toggle="tooltip" data-placement="top" title="Edit Task"></i></a>
                                        {{-- <a class="text-danger mx-1 delete-confirm" href="{{ url('/admin/depo_stocks/soft-delete/'.$item->ds_slug) }}"><i class="fas fa-trash" data-toggle="tooltip" data-placement="top" title="Remove Task"></i></a> --}}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function(){
        $('.delete-confirm').on('click', function (event) {
            event.preventDefault();
            const url = $(this).attr('href');
            swal({
                title: 'Are you sure?',
                text: 'This record moves to Restore and would be inactivated.',
                icon: 'warning',
                buttons: ["Cancel", "Yes!"],
            })
            .then(function(value) {
                if (value) {
                    window.location.href = url;
                }
                else {
                    swal("Don't Worry! Your imaginary file is here.");
                }
            });
        });
        // $('#basic-datatables').DataTable({
		// });
        $('#basic-datatables').DataTable({
            ordering: false,
            responsive: true,
            autoWidth: false,
        });
        $('#basic-datatables-all').DataTable({
            ordering: false,
            responsive: true,
            autoWidth: false,
        });
    });
    
</script>
@endsection