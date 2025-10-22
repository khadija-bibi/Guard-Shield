@extends('layouts.app')
@section('title', 'Company Request-Detail')
@section('content')

    <div>
        <span class="navbar-brand fw-semibold" style="color: #9e9e9e;">
            Customer Management / Request<span class="text-dark"> / Details</span>
        </span>

        <div class="bg-white p-5 rounded shadow-sm">
            <a class="btn-custom btn btn-custom " href="{{route('companies-request.index')}}">Back</a>

            <div class="container">
                <table class="w-full ">
                    <tbody class="bg-white">
                        <tr class="border-b">
                            <th class="px-6 py-3 text-left" >
                                Company Name
                            </th>
                            <td class="px-6 py-3 text-left">
                                {{$company->name}}
                            </td>
                        </tr>
                        <tr class="border-b">
                            <th class="px-6 py-3 text-left" >
                                Company Email
                            </th>
                            <td class="px-6 py-3 text-left">
                                {{$company->email}}
                            </td>
                        </tr>
                        <tr class="border-b">
                            <th class="px-6 py-3 text-left" >
                                Created At
                            </th>
                            <td class="px-6 py-3 text-left">
                                {{\Carbon\Carbon::parse($company -> created_at)->format('d M,Y')}}
                            </td>
                        </tr>
                        <tr class="border-b">
                            <th class="px-6 py-3 text-left" >
                                Company Description
                            </th>
                            <td class="px-6 py-3 text-left">
                                {{$company->description}}
                            </td>
                        </tr>
                        <tr class="border-b">
                            <th class="px-6 py-3 text-left" >
                                Address
                            </th>
                            <td class="px-6 py-3 text-left">
                                {{$company->address}}
                            </td>
                        </tr>
                        <tr class="border-b">
                            <th class="px-6 py-3 text-left" >
                                Status
                            </th>
                            <td class="px-6 py-3 text-left">
                                {{$company->verification_status}}
                            </td>
                        </tr>
                        <tr class="border-b">
                            <th class="px-6 py-3 text-left" >
                                Owner
                            </th>
                            <td class="px-6 py-3 text-left">
                                {{$company->user->name}}
                            </td>
                        </tr>
                        <tr class="border-b">
                            <th class="px-6 py-3 text-left" >
                                Owner's Email
                            </th>
                            <td class="px-6 py-3 text-left">
                                {{$company->user->email}}
                            </td>
                        </tr>
                        <tr class="border-b">
                            <th class="px-6 py-3 text-left" >
                                Documents
                            </th>
                            <td class="px-6 py-3 text-left">
                                @can('view company request doc')
                                <a class="btn btn-info btn-sm" href="{{ route('company-request.docs', $company->id) }}">Open</a>
                                @endcan

                                {{-- {{$company->user->email}} --}}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>  
@endsection