<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Request as ServiceRequest;
use Illuminate\Http\Request;
use App\Models\Response;
use Carbon\Carbon;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
class InvoiceController extends Controller implements HasMiddleware
{
     public static function middleware(): array
    {
        return[
            new Middleware('permission:view request invoices', only: ['viewRequestInvoices','showInvoice']),
        ];
    }
 
    ///// for seeker///////
    public function viewInvoices($requestId)
    {
        $request = ServiceRequest::findOrFail($requestId);

        $today = now()->startOfDay();

        $invoices = Invoice::where('request_id', $request->id)
            ->where(function($query) use ($today) {
                $query->where('status', 'PAID') // show all paid invoices
                    ->orWhere(function($q) use ($today) {
                        $q->where('status', 'PENDING')
                        ->whereDate('billing_start_date', '<=', $today); // use whereDate to ignore time
                    });
            })
            ->orderBy('billing_start_date', 'asc')
            ->get();


        return view('request-form.service.invoice.index', compact('request', 'invoices'));
    }
    public function show($invoiceId)
    {
        $invoice = Invoice::findOrFail($invoiceId);
        $request = $invoice->request; 

        $allInvoices = Invoice::where('request_id', $invoice->request_id)
                            ->orderBy('billing_start_date', 'asc')
                            ->get();

        $sequence = $allInvoices->pluck('id')->search($invoice->id);

        $displayInvoiceNumber = $sequence !== false ? $sequence + 1 : 'N/A';
        
        return view('request-form.service.invoice.show', [
            'invoice' => $invoice,
            'request' => $request,
            'displayInvoiceNumber' => $displayInvoiceNumber 
        ]);
    }

    ///////company//////////
    public function viewRequestInvoices($requestId)
    {
        $request = ServiceRequest::findOrFail($requestId);

        $invoices = Invoice::where('request_id', $request->id)
                            ->orderBy('billing_start_date', 'asc')
                            ->get();

        return view('panel.CRM.service-request.view-invoices', compact('request', 'invoices'));

    } 


    public function showInvoice($invoiceId)
    {   
        $invoice = Invoice::findOrFail($invoiceId);
        $request = $invoice->request; 

        $allInvoices = Invoice::where('request_id', $invoice->request_id)
                            ->orderBy('billing_start_date', 'asc')
                            ->get();

        $sequence = $allInvoices->pluck('id')->search($invoice->id);

        $displayInvoiceNumber = $sequence !== false ? $sequence + 1 : 'N/A';
        
        return view('panel.CRM.service-request.show-invoice', [
            'invoice' => $invoice,
            'request' => $request,
            'displayInvoiceNumber' => $displayInvoiceNumber // ⬅️ Yeh naya variable hai
        ]);
    }

    /////////////////////////////////////////////


    public function generateInvoices(Response $response)
    {
        $requestModel = $response->request;

        $startDate = Carbon::parse($requestModel->date_from);
        $endDate   = Carbon::parse($requestModel->date_to);

        $totalDays = $startDate->diffInDays($endDate) + 1;

        if (strtolower($requestModel->paymentPlan) === 'one_time') {
            // One-time payment
            Invoice::create([
                'request_id' => $requestModel->id,
                'total_days' => $totalDays,
                'month_count' => 1,
                'amount' => $response->quotation,
                'billing_start_date' => $startDate->format('Y-m-d'),
                'billing_end_date' => $endDate->format('Y-m-d'),
                'status' => 'PENDING'
            ]);
        } 
        else {
            // Monthly payment
            $totalDays = $startDate->diffInDays($endDate) + 1;
            $fullMonths = intdiv($totalDays, 30);       // number of full months
            $remainingDays = $totalDays % 30;          // extra days
            $monthlyAmount = $response->quotation;     // full month rate
            $perDayAmount = $monthlyAmount / 30;       // rate for extra days

            // Full month invoices
            for ($i = 0; $i < $fullMonths; $i++) {
                $billingStart = $startDate->copy()->addMonths($i);
                $billingEnd = $billingStart->copy()->addMonth()->subDay();
                Invoice::create([
                    'request_id' => $requestModel->id,
                    'total_days' => $totalDays,
                    'month_count' => $fullMonths,
                    'amount' => $monthlyAmount,
                    'billing_start_date' => $billingStart->format('Y-m-d'),
                    'billing_end_date' => $billingEnd->format('Y-m-d'),
                    'status' => 'PENDING'
                ]);
            }

            // Extra days invoice
            if ($remainingDays > 0) {
                $billingStart = $startDate->copy()->addMonths($fullMonths);
                $billingEnd = $endDate->copy();
                Invoice::create([
                    'request_id' => $requestModel->id,
                    'total_days' => $totalDays,
                    'month_count' => $fullMonths,
                    'amount' => $remainingDays * $perDayAmount,
                    'billing_start_date' => $billingStart->format('Y-m-d'),
                    'billing_end_date' => $billingEnd->format('Y-m-d'),
                    'status' => 'PENDING'
                ]);
            }

        }
    }




    

        public function submitAttachment(Request $request, $id)
        {
            $invoice = Invoice::findOrFail($id);

            // Validate file
            $request->validate([
                'attachment' => 'required|mimes:pdf,jpg,jpeg,png|max:2048'
            ]);

            if ($request->hasFile('attachment')) {
                $file = $request->file('attachment');
                $filename = time().'_'.$file->getClientOriginalName();

                // Move file to uploads/invoices
                $file->move(public_path('uploads/invoices'), $filename);

                // Save filename in invoice
                $invoice->attachment = $filename;
                // $invoice->status = 'PAID';
                $invoice->save();

                $serviceRequest = ServiceRequest::find($invoice->request_id);

            // if ($serviceRequest) {
            //     $serviceRequest->payment_status = 'DONE';
            //     $serviceRequest->save();
            // }
            }

            return redirect()->back()->with('success', 'Invoice attachment submitted successfully!');
        }

    public function paymentStatus($id)
    {
        $id = decrypt($id);
        $invoice = Invoice::findOrFail($id);
        $invoice->status = "PAID";
        $invoice->save();

        // Get all invoices for this request
        $invoices = Invoice::where('request_id', $invoice->request_id)->get();

        // Check if all invoices are PAID
        $allPaid = $invoices->every(fn($inv) => $inv->status === 'PAID');

        if ($allPaid) {
            // Update the request status to DONE
            $request = ServiceRequest::findOrFail($invoice->request_id); // replace RequestModel with your actual Request model
            if ($request) {
                $request->status = 'DONE';
                $request->save();
            }
        }

        return redirect()->back()->with('success', 'Invoice status paid!');
    }

        
    

}