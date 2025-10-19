@extends('layouts.auth')

@section('title', 'Company Frozen')

@section('content')
<div class="container vh-100 d-flex align-items-center justify-content-center">
    <div class="text-center p-4 border rounded" style="color: #1B4D3E; font-weight: 500;">
        <h3 class="mb-3">Your company account has been frozen</h3>
        <p>Your company is temporarily disabled by the administration. Please check your email for more details, or contact support.</p>
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
