@extends('layouts.admin')
@section('page_title','Add New Warehouses')
@section('page-heading','Warehouses')
@section('content')
<div class="row">
    <div class="col-md-12">
        <form method="POST" id="addWarehouseForm" action="{{ url('/admin/warehouses/submit') }}" enctype="multipart/form-data">
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
                                Add Warehouse Information
                            </h2>
                        </div>
                        <div class="col-md-4 d-flex justify-content-end">
                            <a href="{{ url('/admin/warehouses') }}" class="btn btn-sm btn-secondary font-weight-bold text-uppercase">
                                <i class="fas fa-globe"></i>&nbsp; 
                                All Available Warehouses 
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body" style="background-color: rgba(30, 39, 46, 0.05)">

                    <div class="row">
                        
                    
                        <div class="col-md-12">
                            <div class="form-group row border">
                                <label for="name" class="col-sm-2 col-form-label custom_form_label">
                                    Warehouse Name :<span class="req_star">*</span>
                                </label>
                                <div class="col-sm-6">
                                <input type="text" id="name" class="form-control custom_form_control" name="name" placeholder="Warehouse Name">
                                    @error('name')
                                        <span class="alert alert-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
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
{{-- 
@section('script')
<script>
    $(document).ready(function() {
    $('#addProductForm').on('submit', function(e) {
        e.preventDefault();

        // Gather form data
        // let formData = {
        //     product_name: $('#product_name').val(),
        //     generic_name: $('#generic_name').val(),
        //     packing: $('#packing').val(),
        //     specification: $('#specification').val(),
        //     quantity: $('#quantity').val(),
        //     product_img: $('#product_img').val(),
        //     alert_stock: $('#alert_stock').val(),
        //     _token: '{{ csrf_token() }}', // Include CSRF token
        // };

        // AJAX request
        let formData = new FormData(this);
        $.ajax({
            url: "{{ route('products.store') }}",
            type: "POST",
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                if (response.success) {
                swal("Good job!", response.message, "success");
                location.reload();
            }
            },
            error: function(response) {
                alert('An error occurred.');
                console.log(response.responseJSON);
            }
        });
    });
});
</script>

@endsection --}}