@extends('layouts.app')
@section('title', 'Employee Create')
@section('content')
<div>
    <span class="navbar-brand fw-semibold" style="color: #9e9e9e;">
        Employee Management <span class="text-dark"> / Create Employee</span>
    </span>
    <div class="bg-white p-5 rounded shadow-sm">
        @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Success!</strong> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        <a class="btn btn-custom" href="{{ route('employees.index') }}">Back</a>

        <h3 class="text-center fw-bold mb-4" style="color: #005957;">Create Employee</h3>

        <form action="{{ route('employees.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label for="name" class="form-label fw-medium" style="color: #1B4D3E;">Name</label>
                <input type="text" placeholder="Enter employee name" value="{{ old('name') }}" name="name" class="form-control" id="name" style="border-color: #00827F;">
                @error('name')
                    <p class="text-danger font-medium">{{ $message }}</p>  
                @enderror
            </div>

             <div class="mb-3">
                <label for="user_id">Link to Existing User (Optional)</label>
                <select name="user_id" class="form-control">
                    <option value="">-- Select User (Optional) --</option>
                    @foreach($users as $user)
                        <option value="{{ $user->id }}">{{ $user->email }}</option>
                    @endforeach
                </select>
            </div>
            
            <div class="mb-3">
                <label for="phone" class="form-label fw-medium" style="color: #1B4D3E;">Phone</label>
                <input type="text" placeholder="Enter phone number" value="{{ old('phone') }}" name="phone" class="form-control" id="phone" style="border-color: #00827F;">
                @error('phone')
                    <p class="text-danger font-medium">{{ $message }}</p>  
                @enderror
            </div>

            <div class="mb-3">
                <label for="address" class="form-label fw-medium" style="color: #1B4D3E;">Address</label>
                <input type="text" placeholder="Enter address" value="{{ old('address') }}" name="address" class="form-control" id="address" style="border-color: #00827F;">
                @error('address')
                    <p class="text-danger font-medium">{{ $message }}</p>  
                @enderror
            </div>

            <div class="mb-3">
                <label for="image" class="form-label fw-medium" style="color: #1B4D3E;">Image</label>
                <input type="file" name="image" class="form-control" id="image" style="border-color: #00827F;">
                @error('image')
                    <p class="text-danger font-medium">{{ $message }}</p>  
                @enderror
            </div>

            <div class="mb-3">
                <label for="salary" class="form-label fw-medium" style="color: #1B4D3E;">Salary</label>
                <input type="number" placeholder="Enter salary" value="{{ old('salary') }}" name="salary" class="form-control" id="salary" style="border-color: #00827F;">
                @error('salary')
                    <p class="text-danger font-medium">{{ $message }}</p>  
                @enderror
            </div>

            <div class="mb-3">
                <label for="salary_type" class="form-label fw-medium" style="color: #1B4D3E;">Salary Type</label>
                <select name="salary_type" id="salary_type" class="form-control" style="border-color: #00827F;">
                    <option value="">Select Salary Type</option>
                    <option value="Hourly" {{ old('salary_type') == 'Hourly' ? 'selected' : '' }}>Hourly</option>
                    <option value="Monthly" {{ old('salary_type') == 'Monthly' ? 'selected' : '' }}>Monthly</option>
                    <option value="Weekly" {{ old('salary_type') == 'Weekly' ? 'selected' : '' }}>Weekly</option>
                </select>
                @error('salary_type')
                    <p class="text-danger font-medium">{{ $message }}</p>
                @enderror
            </div>


            <div class="mb-3">
                <label for="qualification" class="form-label fw-medium" style="color: #1B4D3E;">Qualification</label>
                <input type="text" placeholder="Enter qualification" value="{{ old('qualification') }}" name="qualification" class="form-control" id="qualification" style="border-color: #00827F;">
                @error('qualification')
                    <p class="text-danger font-medium">{{ $message }}</p>  
                @enderror
            </div>

            <div class="mb-3">
                <label for="designation" class="form-label fw-medium" style="color: #1B4D3E;">Designation</label>
                <input type="text" placeholder="Enter designation" value="{{ old('designation') }}" name="designation" class="form-control" id="designation" style="border-color: #00827F;">
                @error('designation')
                    <p class="text-danger font-medium">{{ $message }}</p>  
                @enderror
            </div>

            <button type="submit" class="btn btn-custom w-100 py-2">Submit</button>
        </form>
    </div>
</div>
@endsection
