@extends('layouts.app')
@section('title', 'Company Feedbacks')
@section('content')

<div>
    <span class="navbar-brand fw-semibold" style="color: #9e9e9e;">
        Reviews and Ratings<span class="text-dark"> / Feedbacks</span>
    </span> 
    <div class="bg-white p-5 rounded shadow-sm">   
        @if($feedbacks->isEmpty())
        <p>No feedbacks given yet.</p>
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
        {{-- <div class="mt-3 d-flex justify-content-end">
            {{ $feedbacks->links() }}
        </div> --}}
    </div>
</div> 

@endsection
