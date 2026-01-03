<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Employee;
use App\Models\Request as ServiceRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }
    public function showDashboard()
    {
        $user = auth()->user();
        $companyId = auth()->user()->company_id;
        $verifiedCompanies = Company::where('verification_status', 'Accepted')
                                    ->where('is_drop', 0)
                                    ->count();
        $pendingRequests = ServiceRequest::where('status', 'Pending')
                                    ->where('payment_status', "Pending")
                                    ->where('company_id', $companyId)
                                    ->count();
        $frozenCompanies = Company::where('verification_status', 'Accepted')
                                    ->where('is_drop', 0)
                                    ->where('is_freeze', 1)
                                    ->count();
        $ongoingRequests = ServiceRequest::where('status', 'Accepted')
                                    ->where('payment_status', "DONE")
                                    ->where('company_id', $companyId)
                                    ->count();
        $employees = Employee::where('company_id', $companyId)
                                    ->count();

        $users = User::where('company_id', $companyId)->count();
        
        if ($user->user_type === "superAdmin" || $user->user_type === "adminEmployee") {
            return view('panel.home.dashboard', [
                'user' => $user,
                'verifiedCompanies' => $verifiedCompanies,
                'pendingRequests' => Company::where('verification_status', 'Pending')->count(),
                'frozenCompanies' => $frozenCompanies,
                'users' => User::where('created_by', 1)->count(),
            ]);
        }

        if ($user->user_type === "companyOwner") {
                $company = $user->company; 

                if ($company) {
                    if ($company->verification_status == "Pending") {
                    return view('auth.pending-request');
                    }
                    if ($company->verification_status == "Reject") {
                        return view('auth.rejected-request');
                    }
                    if ($company->is_freeze) {
                    return view('auth.freeze-company');
                    }
                    if ($company->is_drop) {
                        return view('auth.drop-company');
                    }
                    return view('panel.home.dashboard', [
                                'user' => $user,
                                'employees' => $employees,
                                'ongoingRequests' => $ongoingRequests,
                                'pendingRequests' => $pendingRequests,
                                'users' => $users,
                            ]);            
                }
                return redirect()->route('company.create');
            }

            if ($user->user_type === "serviceSeeker") {
                return redirect()->route('home');
            }
            if ($user->user_type === "companyEmployee") {
                return view('panel.home.dashboard', [
                    'user' => $user,
                    'employees' => $employees,
                    'ongoingRequests' => $ongoingRequests,
                    'pendingRequests' => $pendingRequests,
                    'users' => $users,
            ]);
            }
    }
    public function showHome()
    {
        $user = auth()->user();

        // 1️⃣ Total requests made by the logged-in user
        $totalRequests = \App\Models\Request::where('users_id', $user->id)->count();

        // 2️⃣ Active requests (status = 'Accepted' AND payment_status = 'Paid')
        $activeRequests = \App\Models\Request::where('users_id', $user->id)
            ->where('status', 'ACCEPTED')
            ->where('payment_status', 'DONE')
            ->count();

        // 3️⃣ Total available companies
        $companies = \App\Models\Company::count();

        // Return all to the view
        return view('request-form.service.home', compact('totalRequests', 'activeRequests', 'companies'));
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::attempt($credentials)) {
            return redirect()->route('dashboard');
        }

        return back()->withErrors(['email' => 'Invalid credentials']);
    }


    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }

    public function showSignupForm()
    {
        return view('auth.signup');
    }
    public function signup(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8|confirmed',
            'user_type' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // 1️⃣ Create user
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'user_type' => $request->user_type,
        ]);

      
        $user->update(['created_by' => $user->id]);

       
        if ($request->user_type === 'companyOwner') {
           
            $role = Role::create([
                'name' => 'companyOwner_' . $user->id,
                'role_name' => 'Company Owner',
                'created_by' => $user->id,
            ]);
            $companyPermissionsPart1 = Permission::whereBetween('id', [1, 8])->get();
            $companyPermissionsPart2 = Permission::whereBetween('id', [18, 33])->get();

            // Merge all sets
            $permissions = $companyPermissionsPart1
                ->merge($companyPermissionsPart2)
                ->unique('id');
            $role->syncPermissions($permissions);

            $user->assignRole($role->name);
        }

        Auth::login($user);
        event(new Registered($user));

        session()->flash('success', 'Your account has been created successfully! You can now log in.');

        return redirect()->route('login');
    }


    public function showForgetPassForm()
    {
        return view('auth.forgot_password');
    }

    public function forgotPassword(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $status = Password::sendResetLink($request->only('email'));

        return $status === Password::RESET_LINK_SENT
            ? back()->with('success', 'A password reset link has been sent to your email.')
            : back()->withErrors(['email' => 'We could not find a user with that email address.']);
    }

    public function showResetPasswordForm(string $token)
    {
        return view('auth.reset-password', ['token' => $token]);
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function (User $user, string $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(60));

                $user->save();

                event(new PasswordReset($user));
            }
        );

        return $status === Password::PASSWORD_RESET
            ? redirect()->route('login')->with('status', __($status))
            : back()->withErrors(['email' => [__($status)]]);
    }

    public function showVerifyEmail()
    {
        return view('auth.verify-email');
    }

    public function verifyEmail(EmailVerificationRequest $request)
    {
        $request->fulfill();
        $user = auth()->user();

        if ($user->user_type === 'companyOwner') {
            return redirect()->route('company.create');
        }
        if ($user->user_type === 'serviceSeeker') {
        return redirect()->route('home');
        }
    }

    public function resendVerificationEmail(Request $request)
    {
        $request->user()->sendEmailVerificationNotification();
        return back()->with('message', 'Verification link sent!');
    }
}
