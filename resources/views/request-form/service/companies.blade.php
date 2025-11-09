@extends('layouts.main')
@section('title', 'Companies')
@section('content')

<div class="container py-5">
    <h3 class="text-center mb-4 fw-bold" style="color: #005957;">Available Companies</h3>

    <div class="row g-4">
        @forelse ($companies as $company)
            <div class="col-md-4">
                <div class="card shadow-sm border-0 h-100">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title fw-semibold" style="color: #004d40;">{{ $company->name }}</h5>
                        <p class="card-text text-muted mb-3">{{ $company->email}}</p>

                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <div class="d-flex align-items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-star me-1" width="20" height="20" viewBox="0 0 24 24" stroke-width="1.5" stroke="#f5b301" fill="#f5b301" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                    <path d="M12 17.75l-6.172 3.245l1.179-6.873l-5-4.867l6.9-1l3.093-6.253l3.093 6.253l6.9 1l-5 4.867l1.179 6.873z" />
                                </svg>
                                <span class="fw-medium">{{ number_format($company->feedbacks_avg_rating ?? 0, 1) }}</span>
                            </div>

                            <a href="{{ route('companies.feedbacks', $company->id) }}" class="btn btn-sm btn-link">
                                View Feedback
                            </a>
                        </div>


                        <a class="btn btn-custom mt-auto" data-bs-toggle="modal" data-bs-target="#companyDetailModal{{ $company->id }}">
                            View Details</a>
                        @include('components.companyDetailModal')
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 text-center">
                <p class="text-muted">No companies available at the moment.</p>
            </div>
        @endforelse
    </div>
</div>

<style>
    /* .btn-custom {
        background-color: #00827F;
        color: #fff;
        border-radius: 8px;
        transition: 0.3s;
    }
    .btn-custom:hover {
        background-color: #00695c;
        color: #fff;
    } */
</style>

@endsection
