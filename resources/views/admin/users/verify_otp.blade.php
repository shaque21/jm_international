@extends('layouts.admin')

@section('content')
<div class="container">

    <div class="card">
        <div class="card-header">
            <h2>Verify OTP</h2>
            @if (session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif
        </div>
        <div class="card-body">
            
            <form action="{{ route('admin.users.verify_otp.post') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="otp">Enter OTP</label>
                    <input type="text" name="otp" id="otp" style="width: 60%" class="form-control custom_form_control" required>
                </div>
                <button type="submit" class="btn btn-sm btn-secondary">Verify</button>
            </form>
        </div>
    </div>
</div>
@endsection
