@extends('layouts.auth')
@section('title', 'Reset-Password')
@section('content')
    <div class="d-flex justify-content-center align-items-center min-vh-100">
        <div class="custom-container">
            <h3 class="text-center fw-bold mb-4" style="color: #005957;">Reset Password</h3>

            <form action="{{ route('password.update') }}" method="POST">
                @csrf
                <input type="hidden" name="token" value="{{ $token }}">

                <div class="mb-3">
                    <label for="email" class="form-label fw-medium" style="color: #1B4D3E;">Email</label>
                    <input type="email" value="{{ old('email') }}" name="email" class="form-control" id="email" style="border-color: #00827F;">
                    @error('email')
                        <p class="text-danger font-medium">{{$message}}</p>  
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label fw-medium" style="color: #1B4D3E;">Password</label>
                    <input type="password" name="password" class="form-control" id="password" style="border-color: #00827F;">
                    @error('password')
                        <p class="text-danger font-medium">{{$message}}</p>  
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="password_confirmation" class="form-label fw-medium" style="color: #1B4D3E;">Confirm Password</label>
                    <input type="password" name="password_confirmation" class="form-control" id="password_confirmation" style="border-color: #00827F;">
                    @error('password_confirmation')
                        <p class="text-danger font-medium">{{$message}}</p>  
                    @enderror
                </div>

                <button type="submit" class="btn btn-custom w-100 py-2">Reset Password</button>
            </form>
        </div>
    </div>
@endsection

