<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company;
use Illuminate\Support\Facades\Validator;

class CompanyRequestController extends Controller
{
    public function index()
    {
        // $users = User::where('created_by', auth()->id())->latest()->get(); // Filter users by current user ID
        // $roles = Role::where('created_by', auth()->id())->orderBy('role_name', 'ASC')->get(); // Filter roles by current user ID
        // // dd($roles);
        $companies = Company::Latest()->get();
        return view('panel.customer-management.companies-request.index', [
            'companies' => $companies,
            // 'roles' => $roles,
        ]);
        
    }
    public function detail(String $id){
        $company = Company::with('documents')->findOrFail($id);        
        return view('panel.customer-management.companies-request.detail', [
            'company' => $company,
            // 'roles' => $roles,
        ]);
    }
    public function docs(String $id){
        $company = Company::with('documents')->findOrFail($id);        
        return view('panel.customer-management.companies-request.docs', [
            'company' => $company,
            // 'roles' => $roles,
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

        return redirect()->back()->with('success', "Company request has been {$status}ed.");
    }




}
