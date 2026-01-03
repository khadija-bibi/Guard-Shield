@extends('layouts.app')
@section('title', 'Incidents')
@section('content')

    <div>
        <span class="navbar-brand fw-semibold" style="color: #9e9e9e;">
            Incident Reporting<span class="text-dark"> / Incidents</span>
        </span> 
        <div class="bg-white p-5 rounded shadow-sm">   
        <table class="w-full ">
            <thead class="bg-gray-50">
                <tr class="border-b">
                    <th class="px-6 py-3 text-left" width="60">#</th>
                    <th class="px-6 py-3 text-left">Name</th>
                    <th class="px-6 py-3 text-left">Email</th>
                    <th class="px-6 py-3 text-left">Created_At</th>
                    <th class="px-6 py-3 text-left">Description</th>
                </tr>
            </thead>
            <tbody class="bg-white">
                @if ($incidents -> isNotEmpty())
                @foreach ( $incidents as $key => $incident)
                <tr class="border-b">
                    <td class="px-6 py-3 text-left" width="60">
                        {{ $key + 1 }}
                    </td>
                    <td class="px-6 py-3 text-left">
                        {{$incident -> user->name}}
                    </td>
                    <td class="px-6 py-3 text-left">
                        {{$incident -> user->email}}
                    </td>
                    <td class="px-6 py-3 text-left">
                        {{ \Carbon\Carbon::parse($incident->created_at)->format('d M, Y h:i A') }}
                    </td>
                    <td class="px-6 py-3 text-left">
                        <a class="btn btn-primary btn-sm" 
                            data-bs-toggle="modal" 
                            data-bs-target="#incidentDescModal{{ $incident->id }}">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-info-square-rounded">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                <path d="M12 9h.01" />
                                <path d="M11 12h1v4h1" />
                                <path d="M12 3c7.2 0 9 1.8 9 9s-1.8 9 -9 9s-9 -1.8 -9 -9s1.8 -9 9 -9z" />
                            </svg>
                        </a>
                        @include('components.incidentDescModal', ['incident' => $incident])
                    </td>
                </tr>
                @endforeach 
                @endif
                
            </tbody>
        </table>
        <div class="mt-3 d-flex justify-content-end">
            {{ $incidents->links() }}
        </div>
        </div>
    </div>  
@endsection