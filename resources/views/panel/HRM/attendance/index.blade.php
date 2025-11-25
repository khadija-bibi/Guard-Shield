@extends('layouts.app')
@section('title', 'Attendance')
@section('content')

    <div>
        <span class="navbar-brand fw-semibold" style="color: #9e9e9e;">
            HRM<span class="text-dark"> / Employees</span>
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
                    <th class="px-6 py-3 text-left">Designation</th>
                    <th class="px-6 py-3 text-left">Email</th>
                    <th class="px-6 py-3 text-left">Phone</th>
                    <th class="px-6 py-3 text-center">Action</th>

                </tr>
            </thead>
            <tbody class="bg-white">
                @if ($employees -> isNotEmpty())
                @foreach ( $employees as $key => $employee)
                <tr class="border-b">
                    <td class="px-6 py-3 text-left" width="60">
                        {{ $key + 1 }}
                    </td>
                    <td class="px-6 py-3 text-left">
                        {{$employee -> name}}
                    </td>
                    <td class="px-6 py-3 text-left">
                        {{$employee -> designation}}
                    </td>
                    <td class="px-6 py-3">
                        {{ $employee->user ? $employee->user->email : 'N/A' }}
                    </td>
                    <td class="px-6 py-3">
                        {{ $employee->phone}}
                    </td>
                        
                    <td class="px-6 py-3 text-center">
                        <a class="btn btn-primary btn-sm" href="{{ route('attendance.show', $employee->id) }}">View attendence</a>

                    </td>
                </tr>
                @endforeach 
                @endif
                
            </tbody>
        </table>
        <div class="mt-3 d-flex justify-content-end">
            {{ $employees->links() }}
        </div>
        </div>
    </div>  
@endsection