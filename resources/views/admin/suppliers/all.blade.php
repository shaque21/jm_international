@extends('layouts.admin')
@section('page_title','All Suppliers')
@section('page-heading','Suppliers')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-8 d-flex align-items-center">
                        <h2 class="text-uppercase text-dark font-weight-bold custom_h_size">
                            All Suppliers Information
                        </h2>
                    </div>
                    <div class="col-md-4 d-flex justify-content-end">
                        <a href="{{ url('/admin/suppliers/create') }}" class="btn btn-secondary btn-sm font-weight-bold text-uppercase">
                            <i class="fas fa-cart-plus"></i>&nbsp 
                            Add New Supplier
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
                                <th>Supplier Name</th>
                                <th>Email</th>
                                <th>Mobile</th>
                                <th>Company Name</th>
                                <th>Address</th>
                                {{-- <th>Status</th> --}}
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($allSuppliers as $key=>$item)
                                <tr class="text-center">
                                    <td>{{ $key+1 }}</td>
                                    <td>{{ $item->sup_name }}</td>
                                    <td>{{ $item->email }}</td>
                                    <td>{{ $item->mobile }}</td>
                                    <td>{{ $item->company_name }}</td>
                                    <td>{{ $item->address }}</td>

                                    <td class="text-center">
                                        <a class="text-dark mx-1" href="{{ url('/admin/suppliers/view/'.$item->sup_slug) }}" data-toggle="tooltip" data-placement="top" title="View Task"><i class="fas fa-eye"></i></a>
                                        <a class="text-info mx-1" href="{{ url('/admin/suppliers/edit/'.$item->sup_slug) }}"><i class="fas fa-edit" data-toggle="tooltip" data-placement="top" title="Edit Task"></i></a>
                                        <a class="text-danger mx-1 delete-confirm" href="{{ url('/admin/suppliers/soft-delete/'.$item->sup_slug) }}"><i class="fas fa-trash" data-toggle="tooltip" data-placement="top" title="Remove Task"></i></a>
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