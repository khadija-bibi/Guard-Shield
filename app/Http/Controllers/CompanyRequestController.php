<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company;
use Illuminate\Support\Facades\Validator;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
class CompanyRequestController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return[
            new Middleware('permission:view companies request', only: ['index']),
            new Middleware('permission:view company request detail', only: ['detail']),
            new Middleware('permission:verify company request', only: ['verifyCompany']),
            new Middleware('permission:view company request doc', only: ['docs']),
        ];
    }
    public function index()
    {
        $companies = Company::Latest()->paginate(5); 
        return view('panel.customer-management.companies-request.index', [
            'companies' => $companies,
        ]);
        
    }
    public function detail(String $id){
        $company = Company::with('documents')->findOrFail($id);        
        return view('panel.customer-management.companies-request.detail', [
            'company' => $company,
        ]);
    }
    public function docs(String $id){
        $company = Company::with('documents')->findOrFail($id);        
        return view('panel.customer-management.companies-request.docs', [
            'company' => $company,
        ]);
    }
    
    public function verifyCompany($id, $status)
    {
        $company = Company::find($id);

        if (!$company) {
            return redirect()->back()->with('error', 'Company not found.');
        }

        $company->verification_status = $status;
        $company->save();

        return redirect()->back()->with('success', "Company request has been {$status}.");
    }




}
