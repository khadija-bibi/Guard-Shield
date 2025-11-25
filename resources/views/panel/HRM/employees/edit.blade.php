@extends('layouts.app')
@section('title', 'Employee Edit')
@section('content')
<div>
    <span class="navbar-brand fw-semibold" style="color: #9e9e9e;">
        HRM /Employees<span class="text-dark"> / Edit Employee</span>
    </span>
    <div class="bg-white p-5 rounded shadow-sm">
        @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Success!</strong> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        <a class="btn btn-custom" href="{{ route('employees.index') }}">Back</a>

        <h3 class="text-center fw-bold mb-4" style="color: #005957;">Edit Employee</h3>

        <form action="{{ route('employees.update', $employee->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="name" class="form-label fw-medium" style="color: #1B4D3E;">Name</label>
                <input type="text" value="{{ old('name', $employee->name) }}" name="name" class="form-control" id="name" style="border-color: #00827F;">
                @error('name')
                    <p class="text-danger font-medium">{{ $message }}</p>  
                @enderror
            </div>

            <div class="mb-3">
                <label for="user_id">Linked User (Optional)</label>
                <select name="user_id" class="form-control">
                    <option value="">-- Select User (Optional) --</option>
                    @foreach($users as $user)
                        <option value="{{ $user->id }}" {{ $employee->user_id == $user->id ? 'selected' : '' }}>
                            {{ $user->email }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="phone" class="form-label fw-medium" style="color: #1B4D3E;">Phone</label>
                <input type="text" value="{{ old('phone', $employee->phone) }}" name="phone" class="form-control" id="phone" style="border-color: #00827F;">
                @error('phone')
                    <p class="text-danger font-medium">{{ $message }}</p>  
                @enderror
            </div>

            <div class="mb-3">
                <label for="address" class="form-label fw-medium" style="color: #1B4D3E;">Address</label>
                <input type="text" value="{{ old('address', $employee->address) }}" name="address" class="form-control" id="address" style="border-color: #00827F;">
                @error('address')
                    <p class="text-danger font-medium">{{ $message }}</p>  
                @enderror
            </div>

           <div class="mb-3">
                <label for="image" class="form-label">Employee Image</label><br>

                {{-- Current Image Preview --}}
                @if($employee->image)
                    <div id="current-image">
                        <img src="{{ asset('storage/'.$employee->image) }}" alt="Employee Image" width="120" class="rounded mb-2">
                    </div>
                @endif

                {{-- New Image Preview --}}
                <div id="new-image-preview" class="mb-2" style="display:none;">
                    <img id="preview-img" src="" width="120" class="rounded">
                </div>

                <input type="file" class="form-control" name="image" id="imageInput">
            </div>


            <div class="mb-3">
                <label for="salary" class="form-label fw-medium" style="color: #1B4D3E;">Salary</label>
                <input type="number" value="{{ old('salary', $employee->salary) }}" name="salary" class="form-control" id="salary" style="border-color: #00827F;">
                @error('salary')
                    <p class="text-danger font-medium">{{ $message }}</p>  
                @enderror
            </div>

            <div class="mb-3">
                <label for="salary_type" class="form-label fw-medium" style="color: #1B4D3E;">Salary Type</label>
                <select name="salary_type" id="salary_type" class="form-control" style="border-color: #00827F;">
                    <option value="">Select Salary Type</option>
                    <option value="Hourly" {{ old('salary_type', $employee->salary_type) == 'Hourly' ? 'selected' : '' }}>Hourly</option>
                    <option value="Monthly" {{ old('salary_type', $employee->salary_type) == 'Monthly' ? 'selected' : '' }}>Monthly</option>
                    <option value="Weekly" {{ old('salary_type', $employee->salary_type) == 'Weekly' ? 'selected' : '' }}>Weekly</option>
                </select>
                @error('salary_type')
                    <p class="text-danger font-medium">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-3">
                <label for="qualification" class="form-label fw-medium" style="color: #1B4D3E;">Qualification</label>
                <input type="text" value="{{ old('qualification', $employee->qualification) }}" name="qualification" class="form-control" id="qualification" style="border-color: #00827F;">
                @error('qualification')
                    <p class="text-danger font-medium">{{ $message }}</p>  
                @enderror
            </div>

            <div class="mb-3">
                <label for="designation" class="form-label fw-medium" style="color: #1B4D3E;">Designation</label>
                <input type="text" value="{{ old('designation', $employee->designation) }}" name="designation" class="form-control" id="designation" style="border-color: #00827F;">
                @error('designation')
                    <p class="text-danger font-medium">{{ $message }}</p>  
                @enderror
            </div>

            <button type="submit" class="btn btn-custom w-100 py-2">Update</button>
        </form>
    </div>
</div>
<script>
document.getElementById('imageInput').addEventListener('change', function(event) {
    let file = event.target.files[0];

    if (file) {
        // Hide old image
        let oldImage = document.getElementById('current-image');
        if (oldImage) oldImage.style.display = 'none';

        // Show new preview
        let preview = document.getElementById('preview-img');
        let previewContainer = document.getElementById('new-image-preview');

        preview.src = URL.createObjectURL(file);
        previewContainer.style.display = 'block';
    }
});
</script>

@endsection
