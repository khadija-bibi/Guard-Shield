@extends('layouts.app')
@section('title', 'Company-Detail-Docs')
@section('content')

    <div>
        <span class="navbar-brand fw-semibold" style="color: #9e9e9e;">
            Customer Management / Company / Details<span class="text-dark"> / Documents</span>
        </span> 
        <div class="bg-white p-5 rounded shadow-sm">
            <a class="btn-custom btn btn-custom " href="{{ route('companies.detail', $company->id)}}">Back</a>

            <table class="w-full ">
                <thead class="bg-gray-50">
                    <tr class="border-b">
                        <th class="px-6 py-3 text-left" width="60">#</th>
                        <th class="px-6 py-3 text-left">Name</th>
                        <th class="px-6 py-3 text-center">Action</th>

                    </tr>
                </thead>
                <tbody class="bg-white">
                    @if ($company->documents -> isNotEmpty())
                    @foreach ( $company->documents as $key => $document)
                    <tr class="border-b">
                        <td class="px-6 py-3 text-left" width="60">
                            {{ $key + 1 }}
                        </td>
                        <td class="px-6 py-3 text-left">
                            {{$document->name}}
                        </td>
                        <td class="px-6 py-3 text-center">
                            <a class="btn btn-info btn-sm" href="{{ route('documents.download', $document->id) }}"><svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-download"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 17v2a2 2 0 0 0 2 2h12a2 2 0 0 0 2 -2v-2" /><path d="M7 11l5 5l5 -5" /><path d="M12 4l0 12" /></svg></a>  
                        </td>
                    </tr>
                    @endforeach 
                    @endif
                    
                </tbody>
            </table>
            
        </div>
    </div>  
@endsection