<?php

namespace App\Http\Controllers;

use App\Models\Request as ServiceRequest;
use Illuminate\Http\Request;

class ServiceRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $requests = ServiceRequest::latest()->latest()->paginate(4);
        return view('panel.CRM.service-request.index', [
            'requests' => $requests,
            // 'roles' => $roles,
        ]);
    }

    

    public function detail(String $id){
        $request = ServiceRequest::find($id);        
        return view('panel.CRM.service-request.detail', [
            'request' => $request,
            // 'roles' => $roles,
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

        return redirect()->back()->with('success', "Service request marked as {$status}.");
    }

}
