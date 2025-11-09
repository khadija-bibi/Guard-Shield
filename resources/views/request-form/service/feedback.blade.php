@extends('layouts.main')
@section('title', 'Company Feedbacks')
@section('content')

<div class="container mt-5">
    <a class="btn-custom btn btn-custom " href="{{ url()->previous() }}">Back</a>
    <h3 class="mb-4 " style="color: #004d40;">{{ $company->name }} - Feedbacks</h3>

    @if($feedbacks->isEmpty())
        <p>No feedbacks yet for this company.</p>
    @else
        @foreach($feedbacks as $feedback)
            <div class="card mb-3 shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        {{-- Left side: Username --}}
                        <div>
                            <strong class="text-dark">
                                {{ $feedback->request->user->name ?? 'Unknown User' }}
                            </strong>
                        </div>

                        {{-- Right side: Rating --}}
                        <div class="d-flex align-items-center">
                            <strong class="me-1">Rating:</strong>
                            <span class="text-warning fw-bold">{{ $feedback->rating }} ★</span>
                        </div>
                    </div>

                    {{-- Comment --}}
                    <p class="mt-2">{{ $feedback->comment }}</p>

                    {{-- Date --}}
                    <small class="text-muted">Posted on {{ $feedback->created_at->format('d M, Y') }}</small>
                </div>
            </div>
        @endforeach

    @endif

</div>

@endsection
