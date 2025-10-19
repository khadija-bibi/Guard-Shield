@extends('layouts.app')
@section('title', 'Roles')
@section('content')

    <div>
        <span class="navbar-brand fw-semibold" style="color: #9e9e9e;">
            CRM / Service Request<span class="text-dark"> / Details</span>
        </span>

        <div class="bg-white p-5 rounded shadow-sm">
            <a class="btn-custom btn btn-custom " href="{{route('my-requests.index')}}">Back</a>

            <div class="container">
                <table class="w-full ">
                    <tbody class="bg-white">
                        <tr class="border-b">
                            <th class="px-6 py-3 text-left" >
                                Location
                            </th>
                            <td class="px-6 py-3 text-left">
                                {{$request->location_address}}
                            </td>
                        </tr>
                        <tr class="border-b">
                            <th class="px-6 py-3 text-left" >
                                Status
                            </th>
                            <td class="px-6 py-3 text-left">
                                {{$request->status}}
                            </td>
                        </tr>
                        <tr class="border-b">
                            <th class="px-6 py-3 text-left" >
                                Crew Type
                            </th>
                            <td class="px-6 py-3 text-left">
                                {{$request->crewtype}}
                            </td>
                        </tr>
                        <tr class="border-b">
                            <th class="px-6 py-3 text-left" >
                                Description
                            </th>
                            <td class="px-6 py-3 text-left">
                                {{$request->description}}
                            </td>
                        </tr>
                        <tr class="border-b">
                            <th class="px-6 py-3 text-left" >
                                Severity
                            </th>
                            <td class="px-6 py-3 text-left">
                                {{$request->severity}}
                            </td>
                        </tr>
                         <tr class="border-b">
                            <th class="px-6 py-3 text-left" >
                                Date From
                            </th>
                            <td class="px-6 py-3 text-left">
                                {{\Carbon\Carbon::parse($request -> date_from)->format('d M,Y')}}
                            </td>
                        </tr>
                         <tr class="border-b">
                            <th class="px-6 py-3 text-left" >
                                Date To
                            </th>
                            <td class="px-6 py-3 text-left">
                                {{\Carbon\Carbon::parse($request -> date_to)->format('d M,Y')}}
                            </td>
                        </tr>
                         <tr class="border-b">
                            <th class="px-6 py-3 text-left" >
                                Time From
                            </th>
                            <td class="px-6 py-3 text-left">
                                {{$request->time_from}}
                            </td>
                        </tr>
                         <tr class="border-b">
                            <th class="px-6 py-3 text-left" >
                                Time To
                            </th>
                            <td class="px-6 py-3 text-left">
                                {{$request->time_to}}
                            </td>
                        </tr>
                         <tr class="border-b">
                            <th class="px-6 py-3 text-left" >
                                Payment Plan
                            </th>
                            <td class="px-6 py-3 text-left">
                                {{$request->paymentPlan}}
                            </td>
                        </tr>
                         <tr class="border-b">
                            <th class="px-6 py-3 text-left" >
                                Budget
                            </th>
                            <td class="px-6 py-3 text-left">
                                {{$request->budget}}
                            </td>
                        </tr>
                        <tr class="border-b">
                            <th class="px-6 py-3 text-left" >
                                Created At
                            </th>
                            <td class="px-6 py-3 text-left">
                                {{\Carbon\Carbon::parse($request -> created_at)->format('d M,Y')}}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>  
@endsection