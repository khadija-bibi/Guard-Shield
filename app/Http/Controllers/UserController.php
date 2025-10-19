<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
class UserController extends Controller implements HasMiddleware
{
     public static function middleware(): array
    {
        return[
            // new Middleware('permission:view users', only: ['index']),
            // new Middleware('permission:edit users', only: ['edit']),
            // new Middleware('permission:create users', only: ['create']),
            // new Middleware('permission:delete users', only: ['destroy']),
        ];
    }
    // public function index()
    // {
    //     $users = User::latest()->get();
    //     $roles = Role::orderBy('role_name','ASC')->get();
    //     return view('panel.user-management.users.index',[
    //         'users'=>$users,
    //         'roles'=>$roles
    //     ]);
    // }
public function index()
{
    $authUser = auth()->user();

    if ($authUser->user_type === 'superAdmin') {
        $adminEmployeeIds = User::where('user_type', 'adminEmployee')
                                ->where('created_by', $authUser->id)
                                ->pluck('id');

        $users = User::where(function ($query) use ($authUser, $adminEmployeeIds) {
                    $query->where('created_by', $authUser->id)
                          ->orWhereIn('created_by', $adminEmployeeIds);
                })
                ->latest()
                ->paginate(4);

        $roles = Role::where(function ($query) use ($authUser, $adminEmployeeIds) {
                    $query->where('created_by', $authUser->id)
                          ->orWhereIn('created_by', $adminEmployeeIds);
                })
                ->orderBy('role_name', 'ASC')
                ->get();

    } else if ($authUser->user_type === 'adminEmployee') {
        $superAdminId = $authUser->created_by;

        $users = User::where(function ($query) use ($authUser, $superAdminId) {
                    $query->where('created_by', $authUser->id)
                          ->orWhere('created_by', $superAdminId);
                })
                ->latest()
                ->paginate(4);

        $roles = Role::where(function ($query) use ($authUser, $superAdminId) {
                    $query->where('created_by', $authUser->id)
                          ->orWhere('created_by', $superAdminId);
                })
                ->orderBy('role_name', 'ASC')
                ->get();

    } else if ($authUser->user_type === 'companyOwner') {
        $companyEmployeeIds = User::where('user_type', 'companyEmployee')
                                  ->where('created_by', $authUser->id)
                                  ->pluck('id');

        $users = User::where(function ($query) use ($authUser, $companyEmployeeIds) {
                    $query->where('created_by', $authUser->id)
                          ->orWhereIn('created_by', $companyEmployeeIds);
                })
                ->latest()
                ->paginate(4);

        $roles = Role::where(function ($query) use ($authUser, $companyEmployeeIds) {
                    $query->where('created_by', $authUser->id)
                          ->orWhereIn('created_by', $companyEmployeeIds);
                })
                ->orderBy('role_name', 'ASC')
                ->get();

    } else if ($authUser->user_type === 'companyEmployee') {
        $companyOwnerId = $authUser->created_by;

        $users = User::where(function ($query) use ($authUser, $companyOwnerId) {
                    $query->where('created_by', $authUser->id)
                          ->orWhere('created_by', $companyOwnerId);
                })
                ->latest()
                ->paginate(4);

        $roles = Role::where(function ($query) use ($authUser, $companyOwnerId) {
                    $query->where('created_by', $authUser->id)
                          ->orWhere('created_by', $companyOwnerId);
                })
                ->orderBy('role_name', 'ASC')
                ->get();

    } else {
        abort(403, 'Unauthorized');
    }

    return view('panel.user-management.users.index', compact('users', 'roles'));
}


    /**
     * Show the form for creating a new resource.
     */
    // public function create()
    // {
    //     $roles = Role::orderBy('name','ASC')->get();

    //     return view('panel.user-management.users.create',[
    //         'roles'=> $roles,
    //     ]);
    // }
   public function create()
{
    $user = auth()->user();

    if ($user->user_type === 'superAdmin') {
        $adminEmployeeIds = \App\Models\User::where('user_type', 'adminEmployee')->pluck('id');

        $roles = \Spatie\Permission\Models\Role::whereNotIn('role_name', ['Super Admin'])
            ->where(function ($query) use ($user, $adminEmployeeIds) {
                $query->where('created_by', $user->id)
                      ->orWhereIn('created_by', $adminEmployeeIds);
            })
            ->orderBy('role_name', 'ASC')
            ->get();

    } elseif (in_array($user->user_type, ['companyOwner', 'companyEmployee'])) {
        $companyOwnerId = $user->user_type === 'companyOwner' ? $user->id : $user->created_by;

        $roles = \Spatie\Permission\Models\Role::whereNotIn('role_name', ['Company Owner'])
            ->where(function ($query) use ($companyOwnerId) {
                $query->where('created_by', $companyOwnerId);
            })
            ->orderBy('role_name', 'ASC')
            ->get();
    } else {
        $roles = \Spatie\Permission\Models\Role::where('created_by', $user->id)
            ->orderBy('role_name', 'ASC')
            ->get();
    }

    return view('panel.user-management.users.create', [
        'roles' => $roles,
    ]);
}



    /**
     * Store a newly created resource in storage.
     */
public function store(Request $request)
{
    $authUser = auth()->user();
    $validator = Validator::make($request->all(), [
        'name' => 'required|min:3',
        'email' => 'required|min:3|email|unique:users,email',
        'password' => 'required|min:8',
        'role' => 'required|exists:roles,role_name', 
    ]);

    if ($validator->fails()) {
        return back()->withInput()->withErrors($validator);
    }

    $user = new User();
    $user->name = $request->name;
    $user->email = $request->email;
    $user->password = Hash::make($request->password);
    $user->company_id = auth()->user()->company_id;
    if ($authUser->user_type === 'superAdmin' || $authUser->user_type === 'adminEmployee') {
        $user->user_type = "adminEmployee";
    }
    if ($authUser->user_type === 'companyOwner' || $authUser->user_type === 'companyEmployee') {
        $user->user_type = "companyEmployee";
    }
    $user->created_by = auth()->id();
    $user->save();
    
    $user->markEmailAsVerified(); 
    
    $role = Role::where('role_name', $request->role)->first();
    if ($role) {
        $user->syncRoles([$role->name]); 
    }
    return redirect()->route('users.index')->with('success', 'User created successfully');
}



    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
{
    $editUser = User::findOrFail($id); // jis user ka edit karna hai
    $authUser = auth()->user(); // logged-in user

    if ($authUser->user_type === 'superAdmin') {
        $adminEmployeeIds = \App\Models\User::where('user_type', 'adminEmployee')->pluck('id');

        $roles = \Spatie\Permission\Models\Role::whereNotIn('role_name', ['Super Admin'])
            ->where(function ($query) use ($authUser, $adminEmployeeIds) {
                $query->where('created_by', $authUser->id)
                      ->orWhereIn('created_by', $adminEmployeeIds);
            })
            ->orderBy('role_name', 'ASC')
            ->get();

    } elseif (in_array($authUser->user_type, ['companyOwner', 'companyEmployee'])) {
        $companyOwnerId = $authUser->user_type === 'companyOwner' ? $authUser->id : $authUser->created_by;

        $roles = \Spatie\Permission\Models\Role::whereNotIn('role_name', ['Company Owner'])
            ->where(function ($query) use ($companyOwnerId) {
                $query->where('created_by', $companyOwnerId);
            })
            ->orderBy('role_name', 'ASC')
            ->get();
    } else {
        $roles = \Spatie\Permission\Models\Role::where('created_by', $authUser->id)
            ->orderBy('role_name', 'ASC')
            ->get();
    }

    $hasRoles = $editUser->roles->pluck('role_name')->toArray(); 

    return view('panel.user-management.users.edit', [
        'user' => $editUser,
        'roles' => $roles,
        'hasRoles' => $hasRoles
    ]);
}


/**
 * Update the specified resource in storage.
 */

public function update(Request $request, string $id)
{
    $user = User::findOrFail($id);
    $validator = Validator::make($request->all(), [
        'name' => 'required|min:3',
        'email' => 'required|min:3|email|unique:users,email,' . $id . ',id',
        'role' => 'required|exists:roles,role_name',
    ]);

    if ($validator->fails()) {
        return redirect()->route('users.edit', $id)->withInput()->withErrors($validator);
    }

    $user->name = $request->name;
    $user->email = $request->email;

    if ($request->filled('password')) {
        $user->password = Hash::make($request->password); 
    }

    $user->save();

    // Assign the role directly (only one role)
    $role = Role::where('role_name', $request->role)->first();
    if ($role) {
        $user->syncRoles($role->name); 
    }
   

    return redirect()->route('users.index')->with('success', 'User updated successfully');
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail(decrypt($id));
        $user->delete();
        return redirect()->route('users.index')->with('success', 'Role deleted successfully!');
    }
}
