@extends('layouts.app')

@section('content')

<div class="container mt-4">

    <span class="navbar-brand fw-semibold" style="color: #9e9e9e;">
        CRM / Service Request /Invoices<span class="text-dark"> / View</span>
    </span>
    <br>
    <a class="btn-custom btn btn-custom" href="{{ url()->previous() }}">Back</a>
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
                <strong>Billing Start:</strong> {{ $invoice->billing_start_date }}
            </div>
            <div class="col-md-6">
                <strong>Billing End:</strong> {{ $invoice->billing_end_date }}
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


    </div>

</div>

@endsection
