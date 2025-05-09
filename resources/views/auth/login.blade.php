@extends('layouts.auth')
@section('title', 'Login')
@section('content')
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Success!</strong> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <div class="container vh-100 h-auto d-flex align-items-center">
        <div class="row w-75 w-md-50 mx-auto">
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
            <div class="col-md-6  bg-white d-flex flex-column justify-content-center align-items-center">
                <div class="w-75" >
                    <h3 class="text-center fw-bold" style="color: #005957;font-size: 18px">Welcome Back</h3>
                <p class="text-center" style="font-size: 14px;">You have been missed</p>
                <form action="{{ route('login.post') }}" method="POST">
                    @method('PUT')
                    @csrf
                    <div class="mb-3">
                        <label for="email" class="form-label" style="color: #1B4D3E; font-weight: 500;">Email</label>
                        <input type="email" value="{{old('email')}}" name="email" class="form-control" id="email" style="border-color: #00827F;">
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label" style="color: #1B4D3E; font-weight: 500;">Password</label>
                        <input type="password" name="password" class="form-control" id="password" style="border-color: #00827F;">
                    </div>
                    <div class="mb-3 text-end">
                        <a href="{{ route('password.request') }}" class="text-decoration-none" style="color: #243142; font-weight: 500;">Forgot Password?</a>
                    </div>
                    @if ($errors->any())
                        @foreach ($errors->all() as $error)
                            <p class="mb-1 text-danger ">{{ $error }}</p>
                        @endforeach
                    @endif
                    <button type="submit" class="btn btn-custom w-100">LOGIN</button>
                    <p class="text-center mt-3">Don't have an account? <a href="{{ route('signup') }}" class="text-decoration-none" style="color: #00827F; font-weight: 500">Sign up</a></p>
                </form>
                </div>
                
            </div>
        </div>
    </div>
@endsection

