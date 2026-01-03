@extends('layouts.main')

@section('content')

<div class="container mt-4">

    <span class="navbar-brand fw-semibold" style="color: #9e9e9e;">
        Service Request / Invoices<span class="text-dark"> / View</span>
    </span>
    <br>
    <a class="btn btn-custom btn btn-custom" href="{{ url()->previous() }}">Back</a>
    <div class="card shadow-sm p-4">
        
        {{-- Invoice Basic Details --}}
        <div class="row mb-3">
            <div class="col-md-4">
                <strong>Invoice #:</strong> {{ $displayInvoiceNumber }}
            </div>
            <div class="col-md-4">
                <strong>Amount:</strong> Rs {{ number_format($invoice->amount, 2) }}
            </div>
            <div class="col-md-4">
                <strong>Status:</strong>
                <span class="badge bg-{{ $invoice->status == 'PAID' ? 'success' : 'primary' }}">
                    {{ $invoice->status }}
                </span>
            </div>
        </div>

        {{-- Billing Period --}}
        <div class="row mb-3">
            <div class="col-md-6">
                <strong>Billing Start:</strong> {{\Carbon\Carbon::parse($invoice->billing_start_date)->format('d M,Y')}}
            </div>
            <div class="col-md-6">
                <strong>Billing End:</strong> {{\Carbon\Carbon::parse($invoice->billing_end_date)->format('d M,Y')}}
            </div>
        </div>

        <hr>

        {{-- Attachment Status --}}
        <h5 class="mt-3">Your Attachment</h5>

        @if ($invoice->attachment)
            <p>
                <strong>Uploaded File:</strong><br>
                <a href="{{ asset('uploads/invoices/' . $invoice->attachment) }}" target="_blank">
                    View Attachment
                </a>
            </p>
        @else
            <p class="text-muted">No file submitted yet.</p>
        @endif

        {{-- Upload form — Only if invoice Not Paid --}}
        @if($invoice->status=="PENDING" && $invoice->attachment == null)

            <form action="{{ route('invoice.submit', $invoice->id) }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-3 mt-3">
                    <label class="form-label"><strong>Upload Invoice Proof</strong></label>
                    <input type="file" name="attachment" class="form-control" required>
                    <small class="text-muted">Supported: PDF, JPG, PNG</small>
                </div>

                <button class="btn btn-primary mt-2">
                    Submit
                </button>
            </form>

        @endif

    </div>

</div>

@endsection
