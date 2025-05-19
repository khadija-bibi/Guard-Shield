@extends('layouts.app')
@section('title', 'Roles')
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
                    <td class="px-6 py-3 text-left" width="150">
                        Pending
                    </td>
                    <td class="px-6 py-3 text-center">
                        @can('view company request detail')
                        <a class="btn btn-primary btn-sm" href="{{ route('company-request.detail', $company->id) }}">Details</a>
                        @endcan
                        @can('accept company request')
                        <a class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#acceptModal{{ $company->id }}">
                            Accept
                        </a>
                        @include('components.acceptModal')
                        @endcan
                        @can('reject company request')
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