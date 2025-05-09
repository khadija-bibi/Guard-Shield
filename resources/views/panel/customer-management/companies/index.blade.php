@extends('layouts.app')
@section('title', 'Roles')
@section('content')

    <div>
        <span class="navbar-brand fw-semibold" style="color: #9e9e9e;">
            Customer Management<span class="text-dark"> / Companies</span>
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
                @if ((!$company->is_drop)&&($company->verification_status==="Accept"))
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
                        {{ $company->is_freeze ? 'Frozen' : 'Active' }}
                    </td>
                    <td class="px-6 py-3 text-center">
                        <a class="btn btn-primary btn-sm" href="{{ route('companies.detail', $company->id) }}">Details</a>
                        <a class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#freezeModal">
                            {{ $company->is_freeze ? 'Unfreeze' : 'Freeze' }}
                        </a>
                        @include('components.freezeModal')
                        <a class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#dropModal">
                            Drop
                        </a>
                        @include('components.dropModal')
                </tr>
                @endif
                @endforeach 
                @endif
                
            </tbody>
        </table>
        </div>
    </div>  
@endsection