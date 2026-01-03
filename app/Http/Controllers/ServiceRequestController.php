<?php

namespace App\Http\Controllers;

use App\Models\Request as ServiceRequest;
use App\Models\User;
use App\Notifications\ServiceRequestStatusNotification;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
class ServiceRequestController extends Controller implements HasMiddleware
{
     public static function middleware(): array
    {
        return[
            new Middleware('permission:view requests', only: ['index']),
            new Middleware('permission:view request detail', only: ['detail']),
            new Middleware('permission:verify request', only: ['verifyRequest']),
            new Middleware('permission:verify request payment', only: ['verifyRequest']),
            new Middleware('permission:mark request completed', only: ['markCompleted']),

        ];
    }
   
    public function index()
{
    $userCompanyId = auth()->user()->company_id;

    $requests = ServiceRequest::with('invoices') // eager load invoices
        ->where('company_id', $userCompanyId)
        ->latest()
        ->paginate(5);

    return view('panel.CRM.service-request.index', [
        'requests' => $requests,
    ]);
}


    

    public function detail(String $id){
        $request = ServiceRequest::find($id);        
        return view('panel.CRM.service-request.detail', [
            'request' => $request,
        ]);
    }
    public function verifyRequest($id, $status)
    {
        $request = ServiceRequest::find($id);

        if (!$request) {
            return redirect()->back()->with('error', 'Request not found.');
        }

        $request->status = $status;
        $request->save();

        

        $companyName = auth()->user()->company->name;
        $message = "{$companyName} has {$status} your request..";

        $request->user->notify(new ServiceRequestStatusNotification($request, $message));

        return redirect()->back()->with('success', "Service request has been {$status}.");
    }

    public function verifyPayment($id, $status)
    {
        $request = ServiceRequest::find($id);

        if (!$request) {
            return redirect()->back()->with('error', 'Service request not found.');
        }

        // Ensure valid payment statuses only
        if (!in_array($status, ['PENDING', 'DONE', 'REFUND'])) {
            return redirect()->back()->with('error', 'Invalid payment status.');
        }

        $request->payment_status = $status;
        $request->save();


        $companyName = auth()->user()->company->name;
        $message = "{$companyName} has marked payment as DONE for your request.";

        $request->user->notify(new ServiceRequestStatusNotification($request, $message));
        return redirect()->back()->with('success', "Payment status has been marked as {$status}.");
    }

    public function markCompleted($id,$status)
    {
        $request = ServiceRequest::find($id);

        if (!$request) {
            return redirect()->back()->with('error', 'Service request not found.');
        }

        $request->status = $status;
        $request->save();

        $companyName = auth()->user()->company->name;
        $message = "{$companyName} has marked COMPLETED for your request.";

        $request->user->notify(new ServiceRequestStatusNotification($request, $message));

        return redirect()->back()->with('success', "Service request marked as {$status}.");
    }

    public function confirmResponse($id,$status)
    {
        $request = ServiceRequest::find($id);

        if (!$request) {
            return redirect()->back()->with('error', 'Service request not found.');
        }

        $request->status = $status;
        $request->save();

        $companyUsers = User::where('company_id', $request->company_id)->get();
        $seeker = auth()->user()->name;
        $message = "{$seeker} has {$status} the reponse for request.";
        foreach ($companyUsers as $companyUser) {
            $companyUser->notify(new ServiceRequestStatusNotification($request, $message));
        }
        if ($status === 'ACCEPTED') {
        // Find the response for this request
        $response = $request->response()->first(); // assuming 1 response per request
        if ($response) {
            app(\App\Http\Controllers\InvoiceController::class)->generateInvoices($response);
        }
    }
        return redirect()->back()->with('success', "Service request marked as {$status}.");
    }

}
