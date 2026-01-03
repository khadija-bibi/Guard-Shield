@extends('layouts.app')
@section('title', 'Company Requests')
@section('content')

    <div>
        <span class="navbar-brand fw-semibold" style="color: #9e9e9e;">
            Customer Management<span class="text-dark"> / Requests</span>
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
                    <th class="px-6 py-3 text-left">Company Name</th>
                    <th class="px-6 py-3 text-left">Owner</th>
                    <th class="px-6 py-3 text-left">Created At</th>
                    <th class="px-6 py-3 text-left" width="150">Status</th>
                    <th class="px-6 py-3 text-center">Action</th>
                </tr>
            </thead>
            <tbody class="bg-white">
                @if ($companies -> isNotEmpty())
                @foreach ( $companies as $key => $company)
                @if (($company->verification_status==="Pending"))
                <tr class="border-b">
                    <td class="px-6 py-3 text-left" width="60">
                        {{ $key + 1 }}
                    </td>
                    <td class="px-6 py-3 text-left">
                        {{$company -> name}}
                    </td>
                    <td class="px-6 py-3 text-left">
                        {{$company -> user->name}}
                    </td>
                    <td class="px-6 py-3 text-left">
                        {{\Carbon\Carbon::parse($company -> created_at)->format('d M,Y')}}
                    </td>
                    <td class="px-6 py-3 text-left" width="150">
                        <span class="badge text-bg-primary d-inline-flex align-items-center gap-1 px-2 py-1">
                            {{-- Pending Icon --}}
                            <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-clock"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M3 12a9 9 0 1 0 18 0a9 9 0 0 0 -18 0" /><path d="M12 7v5l3 3" /></svg>
                            Pending
                        </span>
                    </td>
                    <td class="px-6 py-3 text-center">
                        @can('view company request detail')
                        <a class="btn btn-primary btn-sm" href="{{ route('company-request.detail', $company->id) }}">
                            Details</a>
                        @endcan
                        @can('verify company request')
                        <a class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#acceptModal{{ $company->id }}">
                            Accept
                        </a>
                        @include('components.acceptModal')
                        <a class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#rejectModal{{ $company->id }}">
                            Reject
                        </a>
                        @include('components.rejectModal')
                        @endcan
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