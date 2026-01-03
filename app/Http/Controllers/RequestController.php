<?php

namespace App\Http\Controllers;

use App\Models\AreaZone;
use App\Models\Company;
use App\Models\Location;
use App\Models\Request as ServiceRequest;
use App\Models\User;
use App\Notifications\NewServiceRequestNotification;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
class RequestController extends Controller
{

// In ServiceRequestController.php

// public function getPaymentPlans(Request $request)
// {
//     $from = Carbon::parse($request->date_from);
//     $to   = Carbon::parse($request->date_to);

//     // DURATION KO DINON MEIN CALCULATE KAREIN
//     $totalDays = $from->diffInDays($to);

//     // Payment Plan Decision: Agar duration 30 din ya usse zyada hai
//     if ($totalDays >= 30) { 
//         $allowedPlans = ['Monthly', 'One_time'];
//     } else {
//         // Agar duration 30 din se kam hai
//         $allowedPlans = ['One_time'];
//     }

//     return response()->json([
//         'plans' => $allowedPlans
//     ]);
// }
 
    public function index()
{
    $requests = ServiceRequest::with('feedback') // eager load feedback
        ->where('users_id', Auth::id())
        ->latest()
        ->get(); 

    return view('request-form.service.index', [
        'requests' => $requests,
    ]);
}


    public function detail(String $id){
        $request = ServiceRequest::find($id);        
        return view('request-form.service.detail', [
            'request' => $request,
            // 'roles' => $roles,
        ]);
    }
    public function createServiceReq()
    {
        $companies = Company::where('verification_status', 'Accepted')
        ->where('is_freeze', 0)
        ->where('is_drop', 0)
        ->get();
        return view('request-form.service.create', compact('companies'));
    }
    public function storeServiceReq(Request $request)
    {
        
        $request->validate([
            'company_id'    => 'required|exists:companies,id',
            'location_address'      => 'required|string|max:255',
            'location_lat' => 'required|numeric|between:-90,90',
            'location_lng' => 'required|numeric|between:-180,180',
            'crewtype'     => 'required|string',
            'description'   => 'nullable|string',
            'severity'      => 'required|string|in:Low,Medium,High',
            'date_from'     => 'required|date',
            'date_to'       => 'required|date|after_or_equal:date_from',
            'time_from'     => 'required|date_format:H:i',
            'time_to'       => 'required|date_format:H:i',
            'paymentPlan'  => 'required|string|in:Monthly,One_time',
            'budget'        => 'required|numeric|min:1',
        ]);

        
        $serviceRequest = new ServiceRequest();
        $serviceRequest->users_id = auth()->id();
        $serviceRequest->company_id = $request->company_id;
        $serviceRequest->location_address  = $request->location_address;
        $serviceRequest->location_lat   = $request->location_lat;
        $serviceRequest->location_lng   = $request->location_lng;
        $serviceRequest->crewtype     = $request->crewtype;
        $serviceRequest->description   = $request->description;
        $serviceRequest->severity      = $request->severity;
        $serviceRequest->date_from     = $request->date_from;
        $serviceRequest->date_to       = $request->date_to;
        $serviceRequest->time_from    = $request->time_from;
        $serviceRequest->time_to    = $request->time_to;
        $serviceRequest->paymentPlan  = $request->paymentPlan;
        $serviceRequest->budget        = $request->budget;
        $serviceRequest->save();

        $companyUsers = User::where('company_id', $serviceRequest->company_id)->get();

        foreach ($companyUsers as $companyUser) {
                    $companyUser->notify(new NewServiceRequestNotification($serviceRequest, auth()->user()));
                }
        return redirect()->route('my-requests.index')->with('success', 'Service Request created successfully!');

    }
    
   
}
