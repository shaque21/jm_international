@extends('layouts.admin')
@section('page_title','Add New Depo')
@section('page-heading','Depos')
@section('content')
<div class="row">
    <div class="col-md-12">
        <form method="POST" id="addDepoForm" action="{{ url('/admin/depos/submit') }}" enctype="multipart/form-data">
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
                                Add Depo Information
                            </h2>
                        </div>
                        <div class="col-md-4 d-flex justify-content-end">
                            <a href="{{ url('/admin/depos') }}" class="btn btn-sm btn-secondary font-weight-bold text-uppercase">
                                <i class="fas fa-globe"></i>&nbsp; 
                                All Available Depos 
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body" style="background-color: rgba(30, 39, 46, 0.05)">

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group row border">
                                <label for="depo_name" class="col-sm-2 col-form-label custom_form_label">
                                    Depo Name :<span class="req_star">*</span>
                                </label>
                                <div class="col-sm-6">
                                <input type="text" id="depo_name" class="form-control custom_form_control" name="depo_name" placeholder="Depo Name">
                                    @error('depo_name')
                                        <span class="alert alert-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        {{-- <div class="col-md-6">
                            <div class="form-group row border">
                                <label for="warehouse_id" class="col-sm-2 col-form-label custom_form_label">
                                    Warehouse Name : <span class="req_star">*</span> 
                                </label>
                                <div class="col-sm-10">
                                    @php
                                        $warehouse = App\Models\Warehouse::where('warehouse_status', 1)->get();
                                    @endphp
                                    <select name="warehouse_id" id="warehouse_id" class="form-control custom_form_control">
                                        <option value="" selected disabled>Select Warehouse</option>
                                        @foreach ($warehouse as $item)
                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('warehouse_id')
                                        <span class="alert alert-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div> --}}
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