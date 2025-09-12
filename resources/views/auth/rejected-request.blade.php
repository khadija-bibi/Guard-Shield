@extends('layouts.auth')

@section('title', 'Request Pending')

@section('content')
<div class="container vh-100 d-flex align-items-center justify-content-center">
    <div class="text-center p-4 border rounded" style="color: #1B4D3E; font-weight: 500;">
        <h3 class="mb-3 text-danger">Your company request has been rejected ❌</h3>
        <p>
            Unfortunately, your request could not be approved. <br>
        </p>
        <p class="mt-3">
            Please check your email for more details, or contact support if you believe this is a mistake.
        </p>
        <a href="{{ route('logout') }}" 
           onclick="event.preventDefault(); document.getElementById('logout-form').submit();" 
           class="btn btn-outline-dark">
            Logout
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
        </form>
    </div>
</div>
@endsection
