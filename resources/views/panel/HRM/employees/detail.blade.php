@extends('layouts.app')
@section('title', 'Roles')
@section('content')

    <div>
        <span class="navbar-brand fw-semibold" style="color: #9e9e9e;">
            Customer Management / Company<span class="text-dark"> / Details</span>
        </span> 
       
        <div class="bg-white p-5 rounded shadow-sm">
        <a class="btn-custom btn btn-custom " href="{{route('employees.index')}}">Back</a>

            <div class="container">
                <table class="w-full ">
                    <tbody class="bg-white">
                        <tr class="border-b">
                            <th class="px-6 py-3 text-left">Name</th>
                            <td class="px-6 py-3 text-left">{{ $employee->name }}</td>
                        </tr>

                        <tr class="border-b">
                            <th class="px-6 py-3 text-left">Phone</th>
                            <td class="px-6 py-3 text-left">{{ $employee->phone }}</td>
                        </tr>

                        <tr class="border-b">
                            <th class="px-6 py-3 text-left">Address</th>
                            <td class="px-6 py-3 text-left">{{ $employee->address }}</td>
                        </tr>

                        <tr class="border-b">
                            <th class="px-6 py-3 text-left">User</th>
                            <td class="px-6 py-3 text-left">
                                {{ $employee->user ? $employee->user->email : 'N/A' }}
                            </td>
                        </tr>

                        <tr class="border-b">
                            <th class="px-6 py-3 text-left">Salary</th>
                            <td class="px-6 py-3 text-left">{{ $employee->salary }}</td>
                        </tr>

                        <tr class="border-b">
                            <th class="px-6 py-3 text-left">Salary Type</th>
                            <td class="px-6 py-3 text-left">{{ $employee->salary_type }}</td>
                        </tr>

                        <tr class="border-b">
                            <th class="px-6 py-3 text-left">Qualification</th>
                            <td class="px-6 py-3 text-left">{{ $employee->qualification }}</td>
                        </tr>

                        <tr class="border-b">
                            <th class="px-6 py-3 text-left">Designation</th>
                            <td class="px-6 py-3 text-left">{{ $employee->designation }}</td>
                        </tr>

                        <tr class="border-b">
                            <th class="px-6 py-3 text-left">Image</th>
                            <td class="px-6 py-3 text-left">
                                @if($employee->image)
                                    <img src="{{ asset('storage/'.$employee->image) }}" alt="Employee Image" width="100" class="rounded">
                                @else
                                    N/A
                                @endif
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>  
@endsection