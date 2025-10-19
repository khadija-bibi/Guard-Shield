@extends('layouts.app')
@section('title', 'Assigned Guards')
@section('content')

<div>
    <span class="navbar-brand fw-semibold" style="color: #9e9e9e;">
        CRM / Service Request <span class="text-dark">/ Response / Assigned Guards</span>
    </span>

    <div class="bg-white p-5 rounded shadow-sm">

        {{-- Back Button --}}
        <a class="btn btn-custom" href="{{ route('services-request.index') }}">Back</a>

        {{-- Success Message --}}
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
                <strong>Success!</strong> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif  

        {{-- Table --}}
        <table class="w-full mt-4">
            <thead class="bg-gray-50">
                <tr class="border-b">
                    <th class="px-6 py-3 text-left" width="60">#</th>
                    <th class="px-6 py-3 text-left">Name</th>
                    <th class="px-6 py-3 text-left">Phone</th>
                    <th class="px-6 py-3 text-left">Designation</th>
                    <th class="px-6 py-3 text-left">Qualification</th>
                    <th class="px-6 py-3 text-center">Image</th>
                </tr>
            </thead>

            <tbody class="bg-white">
                @if($response->employees && $response->employees->isNotEmpty())
                    @foreach($response->employees as $key => $employee)
                        <tr class="border-b">
                            <td class="px-6 py-3 text-left">{{ $key + 1 }}</td>
                            <td class="px-6 py-3 text-left">{{ $employee->name }}</td>
                            <td class="px-6 py-3 text-left">{{ $employee->phone }}</td>
                            <td class="px-6 py-3 text-left">{{ $employee->designation }}</td>
                            <td class="px-6 py-3 text-left">{{ $employee->qualification }}</td>
                            <td class="px-6 py-3 text-center">
                                <a class="btn btn-primary btn-sm" 
                                    data-bs-toggle="modal" 
                                    data-bs-target="#imageModal{{ $employee->id }}">
                                    View
                                </a>
                        @include('components.imageModal', ['employee' => $employee])
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="6" class="text-center py-3 text-muted">No guards assigned to this response.</td>
                    </tr> 
                @endif
            </tbody>
        </table>
    </div>
</div>
@endsection
