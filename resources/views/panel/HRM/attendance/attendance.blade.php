@extends('layouts.app')
@section('title', 'Attendance')
@section('content')

    <div>
        <span class="navbar-brand fw-semibold" style="color: #9e9e9e;">
            HRM / Employee<span class="text-dark"> / Attendance</span>
        </span> 
        <div class="bg-white p-5 rounded shadow-sm">
            @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Success!</strong> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif  
            <a class="btn-custom btn btn-custom " href="{{route('attendance.index')}}">Back</a>
        <table class="w-full ">
            <thead class="bg-gray-50">
                <tr class="border-b">
                    <th class="px-6 py-3 text-left">#</th>
                    <th class="px-6 py-3 text-left">Date</th>
                    <th class="px-6 py-3 text-left">Clock In</th>
                    <th class="px-6 py-3 text-left">Clock Out</th>
                    <th class="px-6 py-3 text-left">Working Hours</th>
                    <th class="px-6 py-3 text-left">Overtime Hours</th>
                    {{-- <th class="px-6 py-3 text-center">Action</th> --}}

                </tr>
            </thead>
            <tbody class="bg-white">
                @if ($attendance -> isNotEmpty())
                @foreach ( $attendance as $key => $attendanc)
                <tr class="border-b">
                    <td class="px-6 py-3 text-left">
                        {{ $key + 1 }}
                    </td>
                    <td class="px-6 py-3 text-left">
                        {{$attendanc -> created_at  ? \Carbon\Carbon::parse($attendanc->created_at)->format('d M, Y') : 'N/A' }}
                    </td>
                    <td class="px-6 py-3 text-left">
                        {{$attendanc -> clock_in  ? \Carbon\Carbon::parse($attendanc->clock_in)->format('h:i A') : 'N/A' }}
                    </td>
                    <td class="px-6 py-3 text-left">
                        {{$attendanc -> clock_out  ? \Carbon\Carbon::parse($attendanc->clock_out)->format('h:i A') : 'N/A' }}
                    </td>
                    <td class="px-6 py-3 text-left">
                        {{$attendanc -> working_hours}}
                    </td>
                    <td class="px-6 py-3 text-left">
                        {{$attendanc -> overtime_hours}}
                    </td>
                        
                    {{-- <td class="px-6 py-3 text-center">
                        <a class="btn btn-primary btn-sm" href="{{ route('attendance.show', $employee->id) }}">View attendence</a>

                    </td> --}}
                </tr>
                @endforeach 
                @endif
                
            </tbody>
        </table>
        <div class="mt-3 d-flex justify-content-end">
            {{ $attendance->links() }}
        </div>
        </div>
    </div>  
@endsection