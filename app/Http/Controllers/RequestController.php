<?php

namespace App\Http\Controllers;

use App\Models\AreaZone;
use App\Models\Company;
use App\Models\Location;
use App\Models\Request as ServiceRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
class RequestController extends Controller
{
    public function create()
    {
        return view('request-form.company.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:45|min:3',
            'address' => 'required|string|max:255|min:3',
            'email' => 'required|email|unique:companies,email',
            'description' => 'required|string|max:255|min:3',
            'documents.*' => 'required|file|mimes:pdf,jpg,png|max:5012',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $company = Company::create([
            'name' => $request->name,
            'address' => $request->address,
            'email' => $request->email,
            'description' => $request->description,
            'bank_name' =>  $request->bank_name,
            'accout_number' =>  $request->account_number,
            'verification_status' => 0,
            'user_id' => auth()->id(),
        ]);

        // Handle file uploads
        if ($request->hasFile('documents')) {
            foreach ($request->file('documents') as $file) {
                $path = $file->store('documents', 'public');

                $company->documents()->create([
                    'name' => $file->getClientOriginalName(),
                    'url' => $path,
                ]);
            }
        }
        // dd($request->all());
        // return redirect()->route('dashboard')->with('success', 'Company details submitted for verification.');
    }
   
    public function index()
    {
        $requests = ServiceRequest::where('users_id', Auth::id())->get(); // ->get() lagana zaroori hai

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
            'location_address'      => 'required|string',
            // 'location_lat'      => 'required|decimal',
            // 'location_lng'      => 'required|decimal',

            'crewtype'     => 'required|string',
            'description'   => 'nullable|string',
            'severity'      => 'required|string|in:Low,Medium,High',
            'date_from'     => 'required|date',
            'date_to'       => 'required|date|after_or_equal:date_from',
            'time_from'     => 'required|date_format:H:i',
            'time_to'       => 'required|date_format:H:i',
            'paymentPlan'  => 'required|string|in:Monthly,Weekly,One_time',
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

        
        return redirect()->back()->with('success', 'Service Request created successfully!');
    }

   
}
