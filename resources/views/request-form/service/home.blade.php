{{-- resources/views/service-seeker/dashboard.blade.php --}}
@extends('layouts.main')

@section('content')

<div class="card mt-5 shadow-sm border-0">
    <div class="card-body text-center py-5">
        <h3 class="fw-bold mb-2">Welcome to Guard Shield 360!</h3>
        <p class="text-muted mb-3">
            A unified platform connecting you with trusted security companies.  
            You can browse companies, create service requests, and share feedback easily.
        </p>
        <a href="{{ route('service-request.create')}}" class="btn btn-custom">
            <i class="ti ti-plus"></i> Create New Request
        </a>
    </div>
</div>
<div class="row row-cards mt-3">
    <!-- Total Requests -->
    <div class="col-sm-6 col-lg-4">
        <div class="card shadow-sm border-0">
            <div class="card-body text-center">
                <div class="text-primary mb-2">
                    <i class="ti ti-list-check" style="font-size: 2rem;"></i>
                </div>
                <h3 class="card-title mb-1">Total Requests</h3>
                <p class="text-muted mb-2">All service requests you’ve made</p>
                <h2 class="fw-bold">{{ $totalRequests ?? 0 }}</h2>
                <a href="{{ route('my-requests.index')}}" class="btn btn-outline-primary btn-sm mt-2">
                    View Requests
                </a>
            </div>
        </div>
    </div>

    <!-- Active Requests -->
    <div class="col-sm-6 col-lg-4">
        <div class="card shadow-sm border-0">
            <div class="card-body text-center">
                <div class="text-warning mb-2">
                    <i class="ti ti-clock" style="font-size: 2rem;"></i>
                </div>
                <h3 class="card-title mb-1">Active Requests</h3>
                <p class="text-muted mb-2">Requests currently being processed</p>
                <h2 class="fw-bold">{{ $activeRequests ?? 0 }}</h2>
                <a href="{{ route('my-requests.index')}}" class="btn btn-outline-warning btn-sm mt-2">
                    Track Status
                </a>
            </div>
        </div>
    </div>

    <!-- Available Companies -->
    <div class="col-sm-6 col-lg-4">
        <div class="card shadow-sm border-0">
            <div class="card-body text-center">
                <div class="text-success mb-2">
                    <i class="ti ti-building" style="font-size: 2rem;"></i>
                </div>
                <h3 class="card-title mb-1">Available Companies</h3>
                <p class="text-muted mb-2">Explore security service providers</p>
                <h2 class="fw-bold">{{ $companies ?? 0 }}</h2>
                <a href="{{ route('companies.show')}}" class="btn btn-outline-success btn-sm mt-2">
                    View Companies
                </a>
            </div>
        </div>
    </div>
</div>


@endsection
