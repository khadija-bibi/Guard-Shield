@extends('layouts.main')
@section('title', 'My Requests')
@section('content')

    <div>
        {{-- <span class="navbar-brand fw-semibold" style="color: #9e9e9e;">
            CRM<span class="text-dark"> / Service Requests</span>
        </span> --}}
        <div class="bg-white p-5 rounded shadow-sm">
            @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Success!</strong> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif   
            <h3 class="text-center fw-bold mb-4" style="color: #005957;">Service Request</h3>   
            <table class="w-full ">
                <thead class="bg-gray-50">
                    <tr class="border-b">
                        <th class="px-6 py-3 text-left" width="60">#</th>
                        <th class="px-6 py-3 text-left" width="200">Location</th>
                        <th class="px-6 py-3 text-left" width="150">Crew Type</th>
                        <th class="px-6 py-3 text-left" width="150">Status</th>
                        <th class="px-6 py-3 text-left" width="160">Payment Status</th>
                        <th class="px-6 py-3 text-center">Action</th>
                    </tr>
                </thead>
                <tbody class="bg-white">
                    @if ($requests -> isNotEmpty())
                    @foreach ( $requests as $key => $request)
                    {{-- @if (($request->status==="pending")) --}}
                    <tr class="border-b">
                        <td class="px-6 py-3 text-left" width="60">
                            {{ $key + 1 }}
                        </td>
                        <td class="px-6 py-3 text-left " width="200">
                            {{$request -> location_address}}
                        </td>
                        <td class="px-6 py-3 text-left">
                            {{$request -> crewtype}}
                        </td>
                        
                        <td class="px-6 py-3 text-left" width="150">
                            @switch($request->status)
                                @case('PENDING')
                                    <span class="badge text-bg-primary d-inline-flex align-items-center gap-1 px-2 py-1">
                                        {{-- Pending Icon --}}
                                        <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-clock"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M3 12a9 9 0 1 0 18 0a9 9 0 0 0 -18 0" /><path d="M12 7v5l3 3" /></svg>
                                        Pending
                                    </span>
                                    @break
                                @case('RESPONDED')
                                    <span class="badge text-bg-secondary d-inline-flex align-items-center gap-1 px-2 py-1" 
                                        >
                                        {{-- Responded Icon --}}
                                        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" 
                                            viewBox="0 0 24 24" fill="none" stroke="white" 
                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round" 
                                            class="icon icon-tabler icon-tabler-message-dots">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                            <path d="M3 20l1.3 -3.9a9 9 0 1 1 3.4 3.4l-3.7 1.5z" />
                                            <path d="M9 10h.01" /><path d="M12 10h.01" /><path d="M15 10h.01" />
                                        </svg>
                                        Responded
                                    </span>
                                    @break

                                @case('REJECTED')
                                    {{-- Rejected: show red text only --}}
                                    <span class="badge text-bg-danger d-inline-flex align-items-center gap-1 px-2 py-1">
                                        {{-- Rejected Icon --}}
                                        <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-circle-x"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" /><path d="M10 10l4 4m0 -4l-4 4" /></svg>

                                        Rejected
                                    </span>
                                    @break

                                @case('ACCEPTED')
                                    <span class="badge text-bg-success d-inline-flex align-items-center gap-1 px-2 py-1">
                                        {{-- Accepted Icon --}}
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-circle-dashed-check"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M8.56 3.69a9 9 0 0 0 -2.92 1.95" /><path d="M3.69 8.56a9 9 0 0 0 -.69 3.44" /><path d="M3.69 15.44a9 9 0 0 0 1.95 2.92" /><path d="M8.56 20.31a9 9 0 0 0 3.44 .69" /><path d="M15.44 20.31a9 9 0 0 0 2.92 -1.95" /><path d="M20.31 15.44a9 9 0 0 0 .69 -3.44" /><path d="M20.31 8.56a9 9 0 0 0 -1.95 -2.92" /><path d="M15.44 3.69a9 9 0 0 0 -3.44 -.69" /><path d="M9 12l2 2l4 -4" /></svg>                Accepted
                                    </span>
                                    @break

                                @case('CANCELLED')
                                <span class="badge d-inline-flex align-items-center gap-1 px-2 py-1" style="background-color:#dc2525b3; color:white;">
                                        {{-- Cancelled Icon --}}
                                        <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-circle-x"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" /><path d="M10 10l4 4m0 -4l-4 4" /></svg>
                                        Cancelled
                                    </span>
                                    @break

                                @case('COMPLETED')
                                    <span class="badge text-bg-info d-inline-flex align-items-center gap-1 px-2 py-1" style="color: white !important;">
                                        {{-- Completed Icon --}}
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-circle-check"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" /><path d="M9 12l2 2l4 -4" /></svg>
                                        Completed
                                    </span>
                                    @break
                            @endswitch
                        </td>
                        <td class="px-6 py-3 text-left width="150"">
                            @switch($request->payment_status)
                                @case('PENDING')
                                    <span class="badge text-bg-primary d-inline-flex align-items-center gap-1 px-2 py-1">
                                        <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-clock"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M3 12a9 9 0 1 0 18 0a9 9 0 0 0 -18 0" /><path d="M12 7v5l3 3" /></svg>
                                        Pending
                                    </span>
                                    @break
                                @case('DONE')
                                    <span class="badge text-bg-success d-inline-flex align-items-center gap-1 px-2 py-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-circle-check"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" /><path d="M9 12l2 2l4 -4" /></svg>
                                        DONE
                                    </span>
                                    @break

                            @endswitch
                        </td>
                        <td class="px-6 py-3 text-center">
                            {{-- @can('view company request detail') --}}
                            <a class="btn btn-primary btn-sm" href="{{ route('my-request.detail', $request->id) }}">
                                Details
                            </a>
                            {{-- @endcan --}}
                            @if ($request->status!="PENDING"&&$request->status!="REJECTED")
                            {{-- @can('view company request detail') --}}
                            <a class="btn btn-info btn-sm" href="{{ route('my-request.response', $request->id) }}">
                                View Response
                            </a>
                            {{-- @endcan --}}  
                            @endif
                            @if ($request->status=="COMPLETED" && !$request->feedback)
                            {{-- @can('view company request detail') --}}
                            <a class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#feedbackModal{{ $request->id }}">
                                Give Feedback
                            </a>
                            @include('components.feedbackModal')
                            {{-- @endcan --}}  
                            @endif
                            @if ($request->status=="ACCEPTED"||$request->status=="COMPLETED")
                            <a class="btn btn-secondary btn-sm" href="{{ route('service-request.invoices', $request->id) }}">
                                View Invoices
                            </a>
                            @endif
                        </td>
                    </tr>
                    {{-- @endif --}}
                    @endforeach 
                    @endif
                    
                </tbody>
            </table>
            
    </div>  
@endsection