@extends('layouts.app')
@section('title', 'Roles - Edit')
@section('content')
    <div>
        <span class="navbar-brand">Home / Dashboard</span>
        <div class="bg-white p-5 rounded shadow-sm">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Success!</strong> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <h3 class="text-center fw-bold mb-4" style="color: #005957;">Edit Role</h3>
            
            <form action="{{ route('roles.update', $role->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="mb-4">
                    <label for="name" class="form-label fw-medium" style="color: #1B4D3E;">Role Name</label>
                    <input type="text" value="{{ old('name', $role->role_name) }}" name="name" class="form-control border-primary" style="border-color: #00827F;"" id="name" placeholder="Enter role name">
                    @error('name')
                        <p class="text-danger font-medium">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="permissions" class="form-label fw-medium" style="color: #1B4D3E;">Select Permissions</label>
                    <select id="permissions" name="permission[]" class="form-control select2-multiple" multiple style="width: 100%; border-color: #00827F;">
                        @foreach ($permissions as $permission)
                            <option value="{{ $permission->name }}" 
                                {{ in_array($permission->name, $hasPermissions->toArray()) ? 'selected' : '' }}>
                                {{ ucfirst($permission->name) }}
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

    <script>
        $(document).ready(function() {
            $('#permissions').select2({
                placeholder: "Select Permissions",
                allowClear: true,
                width: '100%' 
            });
            $('.select2-selection').css({
            'border-color': '#00827F',
            'padding': '0 0 0 6px', 
            'border-radius': '5px' 
            });
        });
    </script>
@endsection
