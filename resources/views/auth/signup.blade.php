@extends('layouts.auth')
@section('title', 'Sign up')
@section('content')
    <div class="container vh-100 h-auto d-flex align-items-center">
        <div class="row w-75 w-md-50 mx-auto">
            <div class="col-md-6  bg-white d-flex flex-column justify-content-center align-items-center">
                <div class="w-75 pt-4">
                    <h3 class="text-center fw-bold" style="color: #005957;font-size: 20px">Sign up</h3>
                <form action="{{ route('signup.post') }}" method="POST">
                    @method('PUT')
                    @csrf
                    <div class="mb-3">
                        <label for="user_type" class="form-label" style="color: #1B4D3E; font-weight: 500;">User Type</label>
                        <select name="user_type" class="form-select" id="user_type" style="border-color: #00827F;">
                            <option value="" disabled {{ old('user_type') === null ? 'selected' : '' }}>Select User Type</option>
                            <option value="companyOwner" {{ old('user_type') == 'companyOwner' ? 'selected' : '' }}>Company Owner</option>
                            <option value="serviceSeeker" {{ old('user_type') == 'serviceSeeker' ? 'selected' : '' }}>Service Seeker</option>
                        </select>                        
                        @error('user_type')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="name" class="form-label" style="color: #1B4D3E; font-weight: 500;">Name</label>
                        <input type="text" value="{{old('name')}}" name="name" class="form-control" id="name" style="border-color: #00827F;">
                        @error('name')
                            <p class="text-danger font-medium">{{$message}}</p>  
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label" style="color: #1B4D3E; font-weight: 500;">Email</label>
                        <input type="text" value="{{old('email')}}" name="email" class="form-control" id="email" style="border-color: #00827F;">
                        @error('email')
                            <p class="text-danger font-medium">{{$message}}</p>  
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label" style="color: #1B4D3E; font-weight: 500;">Password</label>
                        <input type="password" name="password" class="form-control" id="password" style="border-color: #00827F;">
                        @error('password')
                            <p class="text-danger font-medium">{{$message}}</p>  
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="confirm_password" class="form-label" style="color: #1B4D3E; font-weight: 500;">Confirm Password</label>
                        <input type="password" name="password_confirmation" class="form-control" id="confirm_password" style="border-color: #00827F;">
                        @error('password_confirmation')
                            <p class="text-danger font-medium">{{$message}}</p>  
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-custom w-100">Sign Up</button>
                    <p class="text-center mt-3">Already have an account? <a href="{{ route('login') }}" class="text-decoration-none" style="color: #00827F; font-weight: 500">Login</a></p>
                </form>
                </div>
                
            </div>
            <div class="col-md-6 p-5 left-panel d-flex flex-column justify-content-center align-items-center text-center">
                <div class="transparent-box p-5">
                    <div><img src="{{ asset('assets/image1.png') }}" alt="Image" height="90px" width="100px"></div>
                    <h2>
                        <span class="logo-text fw-bolder">Guard Shield</span> 
                        <span class="logo-text2 fw-bolder text-white">360</span>
                    </h2>                
                    <p class="fw-bold" style="color: #00827F;font-size: 24px">Your Security, Our Priority.</p>
                    <p>Protect what matters most with our advanced security solutions.</p>
                </div>
            </div>
        </div>
    </div>
@endsection
