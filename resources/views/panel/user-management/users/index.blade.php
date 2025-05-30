@extends('layouts.app')
@section('title', 'Roles')
@section('content')

    <div>
        <span class="navbar-brand fw-semibold" style="color: #9e9e9e;">
            User Management<span class="text-dark"> / Users</span>
        </span> 
        <div class="bg-white p-5 rounded shadow-sm">
            @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Success!</strong> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif    
            {{-- @can('create users') --}}
            <div class="d-flex justify-content-end">
                <a class="btn btn-custom" href="{{ route('users.create') }}">Create</a>
            </div>
            {{-- @endcan --}}
        <table class="w-full ">
            <thead class="bg-gray-50">
                <tr class="border-b">
                    <th class="px-6 py-3 text-left" width="60">#</th>
                    <th class="px-6 py-3 text-left">Name</th>
                    <th class="px-6 py-3 text-left">Email</th>
                    <th class="px-6 py-3 text-left">Role Name</th>
                    <th class="px-6 py-3 text-left" width="150">Created At</th>

                    <th class="px-6 py-3 text-center">Action</th>

                </tr>
            </thead>
            <tbody class="bg-white">
                @if ($users -> isNotEmpty())
                @foreach ( $users as $key => $user)
                <tr class="border-b">
                    <td class="px-6 py-3 text-left" width="60">
                        {{ $key + 1 }}
                    </td>
                    <td class="px-6 py-3 text-left">
                        {{$user -> name}}
                    </td>
                    <td class="px-6 py-3 text-left">
                        {{$user -> email}}
                    </td>
                    <td class="px-6 py-3 text-left">
                        {{ $user->roles->first()->role_name ?? 'No Role Assigned' }}
                    </td>
                    <td class="px-6 py-3 text-left" width="150">
                        {{\Carbon\Carbon::parse($user -> created_at)->format('d M,Y')}}
                    </td>
                    @if ($user->id!=1)
                    <td class="px-6 py-3 text-center">
                        {{-- @can('edit users') --}}
                        <a class="btn btn-success btn-sm" href="{{ route('users.edit', $user->id) }}"><svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-edit"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" /><path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z" /><path d="M16 5l3 3" /></svg></a>
                        {{-- @endcan --}}
                        {{-- @can('delete users') --}}
                        <a class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')" href="{{ route('users.destroy', encrypt($user->id)) }}" ><svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-trash"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 7l16 0" /><path d="M10 11l0 6" /><path d="M14 11l0 6" /><path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" /><path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" /></svg></a>
                        {{-- @endcan --}}

                    </td>
                    @endif
                </tr>
                @endforeach 
                @endif
                
            </tbody>
        </table>
        <div class="mt-3 d-flex justify-content-end">
            {{ $users->links() }}
        </div>
        </div>
    </div>  
@endsection