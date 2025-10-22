@extends('layouts.app')
@section('title', 'Service Request-Create Response')
@section('content')
<div class="d-flex flex-col justify-content-center align-items-center min-vh-100">
    {{-- <span class="navbar-brand fw-semibold" style="color: #9e9e9e;">
            CRM / Service Request<span class="text-dark"> / Create Response</span>
    </span><br> --}}
    <div class="custom-container">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Success!</strong> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <h3 class="text-center fw-bold mb-4" style="color: #005957;">Create Service Request Response</h3>
        
        <form action="{{ url("/service-request-response/{$request->id}") }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="request_id" value="{{ $request->id }}">

            <div class="mb-3">
                <label for="bank_name" class="form-label fw-medium" style="color: #1B4D3E;">Bank Name</label>
                <input type="text" name="bank_name" class="form-control" id="bank_name" value="{{ $company->bank_name ?? 'N/A' }}" style="border-color: #00827F;" readonly>
            </div>
            <div class="mb-3">
                <label for="account_number" class="form-label fw-medium" style="color: #1B4D3E;">Account Number</label>
                <input type="text" name="account_number" class="form-control" id="account_number" value="{{ $company->account_number ?? 'N/A' }}" style="border-color: #00827F;" readonly>
            </div>
           <div class="mb-3">
                <label for="guard_id" class="form-label fw-medium" style="color: #1B4D3E;">Select Guards</label>
                <select id="guard_id" name="guards[]" class="form-control" multiple style="width: 100%;border-color: #00827F;">
                    @foreach ($employees as $employee)
                        <option value="{{ $employee->id }}">{{ $employee->name }}</option>
                    @endforeach
                </select>
                @error('guards')
                    <p class="text-danger font-medium">{{$message}}</p>  
                @enderror
            </div>
            <div class="mb-3">
                <label for="description" class="form-label fw-medium" style="color: #1B4D3E;">Description</label>
                <textarea type="text" name="description" class="form-control" id="description" style="border-color: #00827F;">{{old('description')}}</textarea>
                @error('description')
                    <p class="text-danger font-medium">{{$message}}</p>  
                @enderror
            </div>
 
              <div class="mb-3">
                <label for="quotation" class="form-label fw-medium" style="color: #1B4D3E;">Quotation</label>
                <input type="number" placeholder="Enter Quotation" value="{{ old('quotation') }}" name="quotation" class="form-control" id="quotation" style="border-color: #00827F;">
                @error('quotation')
                    <p class="text-danger font-medium">{{ $message }}</p>  
                @enderror
            </div>
            <button type="submit" class="btn btn-custom w-100 py-2">Submit!</button>
        </form>
    </div>
</div>

<script>
        $(document).ready(function() {
        $('#guard_id').select2({
            placeholder: "Select Guards",
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
