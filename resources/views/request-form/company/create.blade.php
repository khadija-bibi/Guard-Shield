@extends('layouts.auth')
@section('title', 'Company Onboarding')
@section('content')
<div class="d-flex flex-col justify-content-center  align-items-center min-vh-100">

    <div class="custom-container">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Success!</strong> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <h3 class="text-center fw-bold mb-4" style="color: #005957;">Company Registeration</h3>
        
        <form action="{{ route('company.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label fw-medium" style="color: #1B4D3E;">Name</label>
                <input type="text" value="{{old('name')}}" name="name" class="form-control" id="name" style="border-color: #00827F;">
                @error('name')
                    <p class="text-danger font-medium">{{$message}}</p>  
                @enderror
            </div>

            <div class="mb-3">
                <label for="email" class="form-label fw-medium" style="color: #1B4D3E;">Email</label>
                <input type="email" value="{{old('email')}}" name="email" class="form-control" id="email" style="border-color: #00827F;">
                @error('email')
                    <p class="text-danger font-medium">{{$message}}</p>  
                @enderror
            </div>

            <div class="mb-3">
                <label for="address" class="form-label fw-medium" style="color: #1B4D3E;">Address</label>
                <input type="text" value="{{old('address')}}" name="address" class="form-control" id="address" style="border-color: #00827F;">
                @error('address')
                    <p class="text-danger font-medium">{{$message}}</p>  
                @enderror
            </div>
            <div class="mb-3">
                <label for="description" class="form-label fw-medium" style="color: #1B4D3E;">Description</label>
                <input type="text" value="{{old('description')}}" name="description" class="form-control" id="description" style="border-color: #00827F;">
                @error('description')
                    <p class="text-danger font-medium">{{$message}}</p>  
                @enderror
            </div>
            <input type="hidden" name="verification_status" value="0">
            <div class="mb-3">
                <label for="documents" class="form-label fw-medium" style="color: #1B4D3E;">Upload Documents</label>
                <input type="file" id="documents" name="documents[]" multiple class="form-control" style="border-color: #00827F;" >
                @error('documents')
                    <p class="text-danger font-medium">{{$message}}</p>  
                @enderror
            </div>
            <button type="submit" class="btn btn-custom w-100 py-2">Submit</button>
        </form>
    </div>
    <form action="{{ route('logout') }}" method="POST" >
        @csrf
        <button type="submit" class="btn btn-outline-dark  ms-3" >Logout</button>
    </form>
</div>
{{-- <div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white text-center">
                    <h4>Company Onboarding</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('company.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Company Name</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="address" class="form-label">Address</label>
                            <input type="text" class="form-control" id="address" name="address" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <input type="hidden" name="verification_status" value="0">
                        <div class="mb-3">
                            <label for="documents" class="form-label">Upload Documents</label>
                            <input class="form-control" type="file" id="documents" name="documents[]" multiple>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Submit & Continue</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div> --}}
@endsection
