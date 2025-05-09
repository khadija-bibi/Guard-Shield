@extends('layouts.app')
@section('title', 'Dashboard')
@section('content')
    <div>
        <span class="navbar-brand fw-semibold" style="color: #9e9e9e;">
            Home<span class="text-dark"> / Dashboard </span>
        </span> 
        <div class="bg-white p-5 rounded shadow-sm">
            <h4>Welcome to Dashboard - {{ Auth::user()->name }}</h4>

            <p>Your security, our priority.</p>
            <div class="container my-5">
                <div class="row g-4">
                  <!-- Left Side Image and Weather -->
                  <div class="col-md-6">
                    <div class="h-100 d-flex flex-column justify-content-center align-items-center " style="border-radius: 15px">
                      <img src="{{ asset('assets/hero.png') }}" alt="Hero image" class="img-fluid " style="border-radius: 15px">
                    </div>
                  </div>
              
                  <!-- Right Side Metrics -->
                  <div class="col-md-6">
                    <div class="row g-3">
                      <div class="col-6">
                        <div class="card-small " style="background-color: #154D4B">
                          <h5>Total Companies Registered</h5>
                          <h3>{{ $verifiedCompanies }}</h3>
                        </div>
                      </div>
                      <div class="col-6">
                        <div class="card-small " style="background-color: #1F7972">
                          <h5>Total Requests Pending</h5>
                          <h3>{{ $pendingRequests }}</h3>
                          
                        </div>
                      </div>
                      <div class="col-6">
                        <div class="card-small " style="background-color: #4FB3A8">
                          <h5>Total Companies Frozen</h5>
                          <h3>{{ $frozenCompanies }}</h3>
                        </div>
                      </div>
                      <div class="col-6">
                        <div class="card-small " style="background-color: #96D5C1">
                          <h5>Total Users</h5>
                          <h3>{{ $users }}</h3>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
        </div>
    </div>
@endsection