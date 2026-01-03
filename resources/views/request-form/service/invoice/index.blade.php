@extends('layouts.main')
@section('title', 'Invoices')
@section('content')

<span class="navbar-brand fw-semibold" style="color: #9e9e9e;">
        Service Request<span class="text-dark"> / Invoices</span>
    </span>
<div class="bg-white p-5 rounded shadow-sm">
    
    <a class="btn-custom btn btn-custom " href="{{route('my-requests.index')}}">Back</a>

    @if($invoices->isEmpty())
        <div class="alert alert-info">No invoices available for this request yet.</div>
    @else
        <table class="table table-bordered">
            <thead class="table-light">
                <tr>
                    <th>#</th>
                    <th>Amount</th>
                    <th>Billing Start</th>
                    <th>Billing End</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($invoices as $key => $invoice)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ number_format($invoice->amount, 2) }}</td>
                    <td>{{\Carbon\Carbon::parse($invoice->billing_start_date)->format('d M,Y')}}</td>
                    <td>{{\Carbon\Carbon::parse($invoice->billing_end_date)->format('d M,Y')}}</td>
                    <td>
                        @if($invoice->status === 'PENDING')
                            <span class="badge bg-primary">PENDING</span>
                        @elseif($invoice->status === 'PAID')
                            <span class="badge bg-success">PAID</span>
                        @endif
                    </td>
                    <td>
                        <a class="btn btn-primary btn-sm" href="{{ route('invoice.show', $invoice->id) }}">
                            View
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>

@endsection
