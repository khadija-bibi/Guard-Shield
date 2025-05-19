<?php

namespace App\Http\Controllers;

use App\Models\Company;
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
            'documents.*' => 'required|file|mimes:pdf,jpg,png|max:2048',
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

        return redirect()->route('dashboard')->with('success', 'Company details submitted for verification.');
    }
}
