@extends('layouts.app')
@section('title', 'Role-create')
@section('content')
    <div>
        <span class="navbar-brand fw-semibold" style="color: #9e9e9e;">
            User Management / Users<span class="text-dark"> / Create User</span>
        </span>
        <div class="bg-white p-5 rounded shadow-sm">
            @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Success!</strong> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <a class="btn-custom btn btn-custom " href="{{route('users.index')}}">Back</a>

        <h3 class="text-center fw-bold mb-4" style="color: #005957;">Create User</h3>
        
        <form action="{{ route('users.store') }}" method="POST" >
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label fw-medium" style="color: #1B4D3E;">Name</label>
                <input type="text" placeholder="Enter username" value="{{old('name')}}" name="name" class="form-control " id="name" style="border-color: #00827F;">
                @error('name')
                    <p class="text-danger font-medium">{{$message}}</p>  
                @enderror
            </div>

            <div class="mb-3">
                <label for="email" class="form-label fw-medium" style="color: #1B4D3E;">Email</label>
                <input type="text" placeholder="Enter email" value="{{old('email')}}" name="email" class="form-control " id="email" style="border-color: #00827F;">
                @error('email')
                    <p class="text-danger font-medium">{{$message}}</p>  
                @enderror
            </div>

            <div class="mb-3">
                <label for="password" class="form-label fw-medium" style="color: #1B4D3E;">Password</label>
                <input type="password" placeholder="Enter password" value="{{old('password')}}" name="password" class="form-control " id="password" style="border-color: #00827F;">
                @error('password')
                    <p class="text-danger font-medium">{{$message}}</p>  
                @enderror
            </div>

            <div class="mb-3">
                <label for="role" class="form-label fw-medium" style="color: #1B4D3E;">Select Role</label>
                <select id="role" name="role" class="form-control" style="width: 100%;border-color: #00827F;">
                    <option value="" selected disabled>Select Role</option>
                    @foreach ($roles as $role)
                        <option value="{{ $role->role_name }}">{{ $role->role_name }}</option>
                    @endforeach
                </select>
                @error('role')
                    <p class="text-danger font-medium">{{$message}}</p>  
                @enderror
            </div>
            <button type="submit" class="btn btn-custom w-100 py-2">Submit</button>
        </form>
        </div>
    </div> 
@endsection