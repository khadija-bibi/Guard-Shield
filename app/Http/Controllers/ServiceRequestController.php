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
        $requests = ServiceRequest::Latest()->get();
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


}
