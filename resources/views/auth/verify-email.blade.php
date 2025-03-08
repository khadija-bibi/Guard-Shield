@extends('layouts.auth')
@section('title', 'Email-Verification')
@section('content')
    <div class="container d-flex justify-content-center align-items-center  min-vh-100">
        <div class="card p-4 text-center w-50 ">
            <h3 class="fw-bold " style="color: #005957">Verify Your Email</h3>
            <p>We've sent a verification email to your registered email address.</p>
            <p>Please check your inbox and click the link to verify your account.</p>

            @if (session('message'))
                <div class="alert alert-success" role="alert">
                    {{ session('message') }}
                </div>
            @endif

            <form method="POST" action="{{ route('verification.send') }}">
                @csrf
                <button type="submit" class="btn btn-custom mt-2">Resend Verification Email</button>
            </form>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn btn-outline-dark mt-1">Logout</button>
            </form>
        </div>
    </div>
@endsection
