@extends('layouts.admin')
@section('page_title','Edit Depo')
@section('page-heading','Depo')
@section('content')
<div class="row">
    <div class="col-md-12">
        <form method="POST" action="{{ url('/admin/depos/update')}}" enctype="multipart/form-data">
            @csrf
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-8 d-flex align-items-center">
                            <h2 class="text-uppercase text-dark font-weight-bold custom_h_size">
                                Update Depo's Information
                            </h2>
                        </div>
                        <div class="col-md-4 d-flex justify-content-end">
                            <a href="{{ url('/admin/depos') }}" class="btn btn-sm btn-secondary font-weight-bold text-uppercase">
                                <i class="fas fa-globe"></i>&nbsp; 
                                All Depo Information 
                            </a>
                        </div>
                    </div>
                </div>
                @if (Session::has('update_error'))
                    <script>
                        swal({title: "Opps !",text: "{{ Session::get('update_error') }}",
                            icon: "error",timer: 4000
                            });
                    </script>
                @endif
                <div class="card-body" style="background-color: rgba(30, 39, 46, 0.05)">

                    <input type="hidden" name="id" value="{{ $data['id'] }}">
                    {{-- <input type="hidden" name="product_code" value="{{ $data['product_code'] }}"> --}}
                    <input type="hidden" name="depo_slug" value="{{ $data['depo_slug'] }}">

                    <div class="row">
                        
                    
                        <div class="col-md-12">
                            <div class="form-group row border">
                                <label for="depo_name" class="col-sm-2 col-form-label custom_form_label">
                                    Depo Name :<span class="req_star">*</span>
                                </label>
                                <div class="col-sm-6">
                                <input type="text" id="depo_name" class="form-control custom_form_control" name="depo_name" value="{{$data->depo_name}}">
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
                                            <option value="{{ $item->id }}" {{($data->warehouse_id == $item->id) ? 'selected' : ''}}>
                                                {{ $item->name }}
                                            </option>
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
@section('script')
<script>
    function previewFile(input){
        var file = $("input[type=file]").get(0).files[0];
 
        if(file){
            var reader = new FileReader();
 
            reader.onload = function(){
                $("#previewImg").attr("src", reader.result);
            }
 
            reader.readAsDataURL(file);
        }
    }
</script>
@endsection