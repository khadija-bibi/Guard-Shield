<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company;
use App\Models\Document;
use App\Models\User;
use App\Notifications\NewCompanyRequestNotification;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
class CompanyController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return[
            new Middleware('permission:view companies', only: ['index']),
            new Middleware('permission:view company detail', only: ['detail']),
            new Middleware('permission:drop company', only: ['dropCompany']),
            new Middleware('permission:freeze/unfreeze company', only: ['toggleFreeze']),
            new Middleware('permission:view company doc', only: ['docs']),
        ];
    }
    public function index()
    {
        $companies = Company::Latest()->get();
        return view('panel.customer-management.companies.index', [
            'companies' => $companies,
        ]);
        
    }
    public function detail(String $id){
        $company = Company::with('documents')->findOrFail($id);        
        return view('panel.customer-management.companies.detail', [
            'company' => $company,
        ]);
    }
    public function docs(String $id){
        $company = Company::with('documents')->findOrFail($id);        
        return view('panel.customer-management.companies.docs', [
            'company' => $company,
        ]);
    }
    public function create()
    {
        return view('request-form.company.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:45|min:3|unique:companies,name',
            'address' => 'required|string|max:255|min:3',
            'email' => 'required|email|unique:companies,email',
            'documents' => 'required',
            'description' => 'required|string|max:255|min:3',
            'bank_name' => 'required|string|max:255|min:3',
            'account_number' => 'required|string|max:255|min:3',
            'documents.*' => 'mimes:pdf,jpg,png|max:2048',
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
            'account_number' =>  $request->account_number,
            'user_id' => auth()->id(),
        ]);

        $user = auth()->user();
        $user->company_id = $company->id;
        $user->save();
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
        $admins = User::whereIn('user_type', ['superAdmin', 'adminEmployee'])->get();

        foreach ($admins as $admin) {
            $admin->notify(new NewCompanyRequestNotification($company, auth()->user()));
        }
        return redirect()->route('dashboard')->with('success', 'Company details submitted for verification.');
    }
    public function download($id)
    {
        $document = Document::findOrFail($id);
        return Storage::disk('public')->download($document->url, $document->name);

    }
    public function toggleFreeze(Request $request, $id)
    {
        $company = Company::find($id);
        if ($company) {
            $company->is_freeze = $request->is_freeze;
            $company->save();

            $status = $company->is_freeze ? 'frozen' : 'unfrozen';
            return redirect()->back()->with('success', "Company has been {$status} successfully.");
        }
        return redirect()->back()->with('error', 'Company not found.');
    }
    public function dropCompany(Request $request, $id)
    {
        $company = Company::find($id);
        if ($company) {
            $company->is_drop = $request->is_drop;
            $company->save();

            return redirect()->back()->with('success', 'Company has been dropped successfully.');
        }
        return redirect()->back()->with('error', 'Company not found.');
    }

    public function showCompanies()
    {
        $companies = Company::withAvg('feedbacks', 'rating')
            ->latest()
            ->get();

        return view('request-form.service.companies', compact('companies'));
    }



}
