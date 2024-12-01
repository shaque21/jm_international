@extends('layouts.admin')
@section('page_title','Add New Product')
@section('page-heading','Products')
@section('content')
<div class="row">
    <div class="col-md-12">
        <form method="POST" id="addProductForm" action="{{ url('/admin/products/submit') }}" enctype="multipart/form-data">
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
                                Add Product Information
                            </h2>
                        </div>
                        <div class="col-md-4 d-flex justify-content-end">
                            <a href="{{ url('/admin/products') }}" class="btn btn-sm btn-secondary font-weight-bold text-uppercase">
                                <i class="fas fa-globe"></i>&nbsp; 
                                All Available Products 
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body" style="background-color: rgba(30, 39, 46, 0.05)">

                    <div class="row">
                        <div class="col-md-6 border">
                            <div class="form-group row">
                                <label for="product_name" class="col-sm-2 col-form-label custom_form_label">
                                    Product Name :<span class="req_star">*</span>
                                </label>
                                <div class="col-sm-10">
                                  <input type="text" id="product_name" class="form-control custom_form_control" name="product_name" placeholder="Product Name">
                                    @error('product_name')
                                        <span class="alert alert-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="quantity" class="col-sm-2 col-form-label custom_form_label">
                                    Quantity :<span class="req_star">*</span>
                                </label>
                                <div class="col-sm-10">
                                  <input type="number" id="quantity" class="form-control custom_form_control" name="quantity" value="{{ old('quantity') }}">
                                    @error('quantity')
                                        <span class="alert alert-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="alert_stock" class="col-sm-2 col-form-label custom_form_label">
                                    Alert Stock :<span class="req_star">*</span>
                                </label>
                                <div class="col-sm-10">
                                  <input type="number" id="alert_stock" class="form-control custom_form_control" name="alert_stock" value="{{ old('alert_stock') }}">
                                    @error('alert_stock')
                                        <span class="alert alert-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>


                        <div class="col-md-6 border">
                            <div class="form-group row">
                                <label for="generic_name" class="col-sm-2 col-form-label custom_form_label">
                                    Generic Name :<span class="req_star">*</span>
                                </label>
                                <div class="col-sm-10">
                                  <input type="text" id="generic_name" class="form-control custom_form_control" name="generic_name" placeholder="Generic Name">
                                    @error('generic_name')
                                        <span class="alert alert-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="packing" class="col-sm-2 col-form-label custom_form_label">
                                    Packing :<span class="req_star">*</span>
                                </label>
                                <div class="col-sm-10">
                                  <input type="text" id="packing" class="form-control custom_form_control" name="packing" placeholder="3 X 10">
                                    @error('packing')
                                        <span class="alert alert-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="product_img" class="col-sm-2 col-form-label custom_form_label">
                                    Product Image :<span class="req_star">*</span>
                                </label>
                                <div class="col-sm-10">
                                  <input type="file" id="product_img" class="form-control custom_form_control" name="product_img" value="{{ old('product_img') }}">
                                  @error('product_img')
                                        <span class="alert alert-danger">{{ $message }}</span>
                                 @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-group row border">
                        <label for="specification" class="col-sm-2 col-form-label custom_form_label">
                            Specification :<span class="req_star">*</span>
                        </label>
                        <div class="col-sm-10">
                          <textarea name="specification" id="specification" cols="10" rows="3" class="form-control custom_textarea custom_form_control" placeholder="Specification"></textarea>
                          @error('specification')
                                <span class="alert alert-danger">{{ $message }}</span>
                         @enderror
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