@extends('layouts.app')
@section('title', 'Role-create')
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
        <a class="btn-custom btn btn-custom " href="{{route('roles.index')}}">Back</a>

        <h3 class="text-center fw-bold mb-4" style="color: #005957;">Create Role</h3>
        
        <form action="{{ route('roles.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label fw-medium" style="color: #1B4D3E;">Name</label>
                <input type="text" placeholder="Enter role name" value="{{old('name')}}" name="name" class="form-control " id="name" style="border-color: #00827F;">
                @error('name')
                    <p class="text-danger font-medium">{{$message}}</p>  
                @enderror
            </div>

            <div class="mb-3">
                <label for="permissions" class="form-label fw-medium" style="color: #1B4D3E;">Select Permissions</label>
                <select id="permissions" name="permissions[]" class="form-control" multiple style="width: 100%;border-color: #00827F;">
                    @foreach ($permissions as $permission)
                        <option value="{{ $permission->name }}">{{ $permission->name }}</option>
                    @endforeach
                </select>
                @error('permissions')
                    <p class="text-danger font-medium">{{$message}}</p>  
                @enderror
            </div>
            <button type="submit" class="btn btn-custom w-100 py-2">Submit</button>
        </form>
        </div>
    </div>
    <script>
        $(document).ready(function() {
        $('#permissions').select2({
            placeholder: "Select Permissions",
            allowClear: true,
            width: '100%',
            });
            $('.select2-selection').css({
            'border-color': '#00827F',
            'padding': '0 0 0 6px', 
            'border-radius': '5px' 
            });
        });
    </script> 
@endsection