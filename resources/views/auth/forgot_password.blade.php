@extends('layouts.auth')
@section('title', 'Forget-Password')
@section('content')
    <div class="d-flex flex-col justify-content-center  align-items-center min-vh-100">
        <div class="auth-container">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Success!</strong> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <h3 class="text-center fw-bold mb-4" style="color: #005957;">Forget Password?</h3>
            
            <form action="{{ route('password.email') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="email" class="form-label fw-medium" style="color: #1B4D3E;">Email</label>
                    <input type="email" name="email" class="form-control" id="email" style="border-color: #00827F;">
                    @error('email')
                        <p class="text-danger font-medium">{{$message}}</p>  
                    @enderror
                </div>

                <button type="submit" class="btn btn-custom w-100 py-2">Send Reset Link</button>
            </form>
        </div>
    </div>
@endsection
