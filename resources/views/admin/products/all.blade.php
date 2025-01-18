@extends('layouts.admin')
@section('page_title','All Products')
@section('page-heading','Products')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-8 d-flex align-items-center">
                        <h2 class="text-uppercase text-dark font-weight-bold custom_h_size">
                            All Products Information
                        </h2>
                    </div>
                    <div class="col-md-4 d-flex justify-content-end">
                        <a href="{{ url('/admin/products/create') }}" class="btn btn-secondary btn-sm font-weight-bold text-uppercase">
                            <i class="fas fa-cart-plus"></i>&nbsp 
                            Add new product
                        </a>
                    </div>
                </div>
            </div>
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
            <div class="card-body">
                <div class="table-responsive-sm">
                    <table id="basic-datatables" class="table table-bordered table-striped table-hover">
                        <thead class="">
                            <tr>
                                <th>#</th>
                                <th>Product Name</th>
                                <th>Generic Name</th>
                                <th>Packing</th>
                                <th>Image</th>
                                {{-- <th>Quantity</th> --}}
                                {{-- <th>Alert Stock</th> --}}
                                {{-- <th>Status</th> --}}
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($allProducts as $key=>$product)
                                <tr class="text-center">
                                    <td>{{ $key+1 }}</td>
                                    <td>{{ $product->product_name }}</td>
                                    <td>{{ $product->generic_name }}</td>
                                    <td>{{ $product->packing }}</td>
                                    {{-- <td>{{ $product->product_img }}</td> --}}
                                    {{-- <td>
                                        @if ($product->photo != '')
                                            <img height="30px" src="{{ asset('/uploads/products/'.$product->product_img) }}" alt="Photo" >
                                        @else
                                            <img height="30px" src="{{ asset('uploads/products/product.jpg') }}" alt="Photo" >
                                        @endif
                                    </td> --}}
                                    <td>
                                        @if ($product->product_img && file_exists(public_path('uploads/products/'.$product->product_img)))
                                            <img height="30px" src="{{ asset('uploads/products/'.$product->product_img) }}" alt="Photo" >
                                        @else
                                            <img height="30px" src="{{ asset('uploads/products/product.jpg') }}" alt="Photo" >
                                        @endif
                                    </td>
                                    
                                    {{-- <td>{{ $product->product_status }}</td> --}}
                                    <td class="text-center">
                                        <a class="text-dark mx-1" href="{{ url('/admin/products/view/'.$product->product_slug) }}" data-toggle="tooltip" data-placement="top" title="View Task"><i class="fas fa-eye"></i></a>
                                        <a class="text-info mx-1" href="{{ url('/admin/products/edit/'.$product->product_slug) }}"><i class="fas fa-edit" data-toggle="tooltip" data-placement="top" title="Edit Task"></i></a>
                                        <a class="text-danger mx-1 delete-confirm" href="{{ url('/admin/products/soft-delete/'.$product->product_slug) }}"><i class="fas fa-trash" data-toggle="tooltip" data-placement="top" title="Remove Task"></i></a>
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
        });
    });
    
</script>
@endsection