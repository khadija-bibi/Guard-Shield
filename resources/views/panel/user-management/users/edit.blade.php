@extends('layouts.app')
@section('title', 'User-Edit')
@section('content')
    <div>
        <span class="navbar-brand fw-semibold" style="color: #9e9e9e;">
            User Management / Users<span class="text-dark"> / Edit User</span>
        </span>

        <div class="bg-white p-5 rounded shadow-sm">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Success!</strong> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <a class="btn-custom btn btn-custom " href="{{route('users.index')}}">Back</a>

            <h3 class="text-center fw-bold mb-4" style="color: #005957;">Edit User</h3>
            
            <form action="{{ route('users.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="mb-4">
                    <label for="name" class="form-label fw-medium" style="color: #1B4D3E;">Name</label>
                    <input type="text" value="{{ old('name', $user->name) }}" name="name" class="form-control " style="border-color: #00827F;"" id="name" placeholder="Enter name">
                    @error('name')
                        <p class="text-danger font-medium">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="email" class="form-label fw-medium" style="color: #1B4D3E;">Email</label>
                    <input type="text" value="{{ old('name', $user->email) }}" name="email" class="form-control " style="border-color: #00827F;"" id="email" placeholder="Enter email">
                    @error('email')
                        <p class="text-danger font-medium">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="password" class="form-label fw-medium" style="color: #1B4D3E;">New Password (Optional)</label>
                    <input type="text"  name="password" class="form-control border-primary" style="border-color: #00827F;"" id="password" placeholder="Enter new password">
                    @error('name')
                        <p class="text-danger font-medium">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="role" class="form-label fw-medium" style="color: #1B4D3E;">Select Role</label>
                    <select id="role" name="role" class="form-control" style="width: 100%; border-color: #00827F;">
                        <option disabled value="" {{ empty($hasRoles) ? 'selected' : '' }}>Select Role</option>
                        @foreach ($roles as $role)
                            <option value="{{ $role->role_name }}" 
                                {{ in_array($role->role_name, $hasRoles) ? 'selected' : '' }}>
                                {{ $role->role_name }}
                            </option>
                        @endforeach
                    </select>
                    
                    @error('permission')
                        <p class="text-danger font-medium">{{ $message }}</p>
                    @enderror
                </div>

                <div class="d-flex justify-content-center">
                    <button type="submit" class="btn btn-custom w-100 py-2">Update</button>
                </div>
            </form>
        </div>
    </div>

@endsection
