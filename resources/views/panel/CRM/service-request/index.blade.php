@extends('layouts.app')
@section('title', 'Roles')
@section('content')

    <div>
        <span class="navbar-brand fw-semibold" style="color: #9e9e9e;">
            CRM<span class="text-dark"> / Service Requests</span>
        </span>
        <div class="bg-white p-5 rounded shadow-sm">
            @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Success!</strong> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif      
        <table class="w-full ">
            <thead class="bg-gray-50">
                <tr class="border-b">
                    <th class="px-6 py-3 text-left" width="60">#</th>
                    <th class="px-6 py-3 text-left">Name</th>
                    <th class="px-6 py-3 text-left">Location</th>
                    <th class="px-6 py-3 text-left" width="150">Crew Type</th>
                    <th class="px-6 py-3 text-left" width="150">Severity</th>
                    <th class="px-6 py-3 text-left" width="150">Status</th>
                    <th class="px-6 py-3 text-center">Action</th>
                </tr>
            </thead>
            <tbody class="bg-white">
                @if ($requests -> isNotEmpty())
                @foreach ( $requests as $key => $request)
                @if (($request->status==="pending"))
                <tr class="border-b">
                    <td class="px-6 py-3 text-left" width="60">
                        {{ $key + 1 }}
                    </td>
                    <td class="px-6 py-3 text-left">
                        {{$request -> user->name}}
                    </td>
                    <td class="px-6 py-3 text-left">
                        {{$request -> location->name}}
                    </td>
                    <td class="px-6 py-3 text-left">
                        {{$request -> crewtype}}
                    </td>
                    <td class="px-6 py-3 text-left">
                        {{$request -> severity}}
                    </td>
                    <td class="px-6 py-3 text-left" width="150">
                        Pending
                    </td>
                    <td class="px-6 py-3 text-center">
                        {{-- @can('view company request detail') --}}
                        <a class="btn btn-primary btn-sm" href="{{ route('service-request.detail', $request->id) }}">Details</a>
                        {{-- @endcan --}}
                        {{-- @can('accept company request') --}}
                        <a class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#reqAcceptModal{{ $request->id }}">
                            Accept
                        </a>
                        @include('components.reqAcceptModal')
                        {{-- @endcan --}}
                        {{-- @can('reject company request') --}}
                        <a class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#reqRejectModal{{ $request->id }}">
                            Reject
                        </a>
                        @include('components.reqRejectModal')
                        {{-- @endcan --}}
                    </td>
                </tr>
                @endif
                @endforeach 
                @endif
                
            </tbody>
        </table>
        </div>
    </div>  
@endsection