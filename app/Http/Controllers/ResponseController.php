<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\Request as ServiceRequest;
class ResponseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($requestId)
    {
        $companyId = auth()->user()->company_id;
        $request = ServiceRequest::findOrFail($requestId);
        $company = \App\Models\Company::find($companyId);
        $employees = Employee::where('company_id', $companyId)
             ->where('designation', 'guard')->get();
        return view('panel.CRM.service-request.create-response', compact('employees','request','company'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $id)
    {
        
    dd($request->all());

        $validator = Validator::make($request->all(), [
                    'guards' => 'required|array|min:1',
                    'description' => 'required|string|max:1000',
                    'quotation' => 'required|numeric|min:1',
                ]);
                
        if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }
        $response = Response::create([
            'request_id' => $request->request_id, 
            'company_id' => Auth::user()->company_id, 
            'description' => $request->description,
            'quotation' => $request->quotation,
        ]);

        // Guards ko attach karo (pivot table me)
        $response->employees()->attach($request->guards);
        \App\Models\Request::where('id', $id)->update(['status' => 'RESPONDED']);
        dd($request->all());
        return redirect()->route('services-request.index')
            ->with('success', 'Service Request Response created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $response = Response::with('company')->where('request_id', $id)->first(); // ya Response::find($id)
        
        if (!$response) {
            return redirect()->back()->with('error', 'No response found for this request.');
        }

        return view('request-form.service.response', compact('response'));
    }
    public function showGuards($id)
{
    $response = Response::find($id);

    if (!$response) {
        return redirect()->back()->with('error', 'No response found.');
    }

    return view('request-form.service.response-guards', compact('response'));
}

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
