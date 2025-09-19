<?php

namespace App\Http\Controllers;

use App\Models\AreaZone;
use App\Models\Company;
use App\Models\Location;
use App\Models\Request as ServiceRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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
dd($request->all());
        // return redirect()->route('dashboard')->with('success', 'Company details submitted for verification.');
    }
    public function createServiceReq()
    {
        $locations = Location::all();
        $companies = Company::where('verification_status', 'Accepted')
        ->where('is_freeze', 0)
        ->where('is_drop', 0)
        ->get();
        return view('request-form.service.create', compact('locations', 'companies'));
    }
    public function storeServiceReq(Request $request)
    {
        
        $request->validate([
            'company_id'    => 'required|exists:companies,id',
            'location_id'      => 'required|exists:locations,id',
            'area_zone_id'     => 'required|exists:area_zones,id',
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
        $serviceRequest->location_id   = $request->location_id;
        $serviceRequest->area_zone_id  = $request->area_zone_id;
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

    public function getZones($locationId)
    {
        $zones = AreaZone::where('location_id', $locationId)->get();
        return response()->json($zones);
    }
}
