@extends('layouts.app')
@section('title', 'Roles')
@section('content')

    <div>
        <span class="navbar-brand fw-semibold" style="color: #9e9e9e;">
            CRM / Service Request<span class="text-dark"> / Response</span>
        </span>

        <div class="bg-white p-5 rounded shadow-sm">
            <a class="btn-custom btn btn-custom " href="{{route('services-request.index')}}">Back</a>

            <div class="container">
                <table class="w-full">
                    <tbody class="bg-white">
                        <tr class="border-b">
                            <th class="px-6 py-3 text-left">Quotation</th>
                            <td class="px-6 py-3 text-left">{{ $response->quotation }}</td>
                        </tr>
                        <tr class="border-b">
                            <th class="px-6 py-3 text-left">Description</th>
                            <td class="px-6 py-3 text-left">{{ $response->description }}</td>
                        </tr>
                        <tr class="border-b">
                            <th class="px-6 py-3 text-left">Guard(s)</th>
                            <td class="px-6 py-3 text-left">
                                <a class="btn btn-primary btn-sm" href="{{ route('my-request.response.guards', $response->id) }}">View</a>
                            </td>
                        </tr>
                    </tbody>
                </table>

                <!-- Payment Section (Outside Table) -->
                <p class="fw-bold mt-4 mb-2 d-flex align-items-center gap-2"
                style="color: #00827F; font-size: 14px;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                        viewBox="0 0 24 24" fill="none" stroke="#00827F" stroke-width="2"
                        stroke-linecap="round" stroke-linejoin="round"
                        class="icon icon-tabler icon-tabler-credit-card">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                        <path d="M3 7h18a2 2 0 0 1 2 2v6a2 2 0 0 1 -2 2h-18a2 2 0 0 1 -2 -2v-6a2 2 0 0 1 2 -2" />
                        <path d="M3 10h18" /><path d="M7 15h.01" /><path d="M11 15h2" />
                    </svg>
                    Payment Details
                </p>

                <table class="w-full">
                    <tbody class="bg-white">
                        <tr class="border-b">
                            <th class="px-6 py-3 text-left">Bank Name</th>
                            <td class="px-6 py-3 text-left">{{ $response->company->bank_name ?? 'N/A' }}</td>
                        </tr>
                        <tr class="border-b">
                            <th class="px-6 py-3 text-left">Account Number</th>
                            <td class="px-6 py-3 text-left">{{ $response->company->account_number ?? 'N/A' }}</td>
                        </tr>
                    </tbody>
                </table>
                @if ()
                {{-- @can('reject company request') --}}
                <a class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#reqAcceptModal{{ $response->request_id }}">
                    Accept
                </a>
                @include('components.reqAcceptModal')
                {{-- @endcan --}} 
                {{-- {-- @can('reject company request') --}} 
                <a class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#reqCancelModal{{ $response->request_id }}">
                    Cancel
                </a>
                @include('components.reqCancelModal')
                {{-- @endcan --}}
                @endif
                
            </div>

        </div>
    </div>  
@endsection