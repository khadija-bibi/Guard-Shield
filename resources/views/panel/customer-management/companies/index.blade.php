@extends('layouts.app')
@section('title', 'Companies')
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
                    <th class="px-6 py-3 text-left">Created At</th>
                    <th class="px-6 py-3 text-left" width="150">Status</th>
                    <th class="px-6 py-3 text-center">Action</th>
                </tr>
            </thead>
            <tbody class="bg-white">
                @if ($companies -> isNotEmpty())
                @foreach ( $companies as $key => $company)
                @if ((!$company->is_drop)&&($company->verification_status==="Accepted"))
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
                        @if ($company->is_freeze)
                            <span class="badge text-bg-primary d-inline-flex align-items-center gap-1 px-2 py-1">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" 
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" 
                                    stroke-linejoin="round" class="icon icon-tabler icon-tabler-snowflake">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                    <path d="M10 4l2 1l2 -1" />
                                    <path d="M12 2v6" />
                                    <path d="M10 20l2 -1l2 1" />
                                    <path d="M12 22v-6" />
                                    <path d="M4 10l1 2l-1 2" />
                                    <path d="M2 12h6" />
                                    <path d="M20 10l-1 2l1 2" />
                                    <path d="M22 12h-6" />
                                    <path d="M6 6l1.5 1.5" />
                                    <path d="M17.5 17.5l1.5 1.5" />
                                    <path d="M6 18l1.5 -1.5" />
                                    <path d="M17.5 6.5l1.5 -1.5" />
                                </svg>
                                Frozen
                            </span>
                        @else
                            <span class="badge text-bg-success d-inline-flex align-items-center gap-1 px-2 py-1">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" 
                                    stroke-linejoin="round" class="icon icon-tabler icon-tabler-circle-check">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                    <path d="M12 2a10 10 0 1 0 10 10a10 10 0 0 0 -10 -10" />
                                    <path d="M9 12l2 2l4 -4" />
                                </svg>
                                Active
                            </span>
                        @endif
                    </td>

                    <td class="px-6 py-3 text-center">
                        @can('view company detail')
                        <a class="btn btn-primary btn-sm" href="{{ route('companies.detail', $company->id) }}">Details</a>
                        @endcan
                        @can('freeze/unfreeze company')
                        <a class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#freezeModal">
                            {{ $company->is_freeze ? 'Unfreeze' : 'Freeze' }}
                        </a>
                        @include('components.freezeModal')
                        @endcan
                        @can('drop company')
                        <a class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#dropModal">
                            Drop
                        </a>
                        @include('components.dropModal')
                        @endcan
                </tr>
                @endif
                @endforeach 
                @endif
                
            </tbody>
        </table>
        </div>
    </div>  
@endsection