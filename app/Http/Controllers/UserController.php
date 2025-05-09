<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
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
    $users = User::where('created_by', auth()->id())
    ->latest()
    ->paginate(4);
    $roles = Role::where('created_by', auth()->id())->orderBy('role_name', 'ASC')->get(); // Filter roles by current user ID
    // dd($roles);
    return view('panel.user-management.users.index', [
        'users' => $users,
        'roles' => $roles,
    ]);
    
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
    // $roles = Role::where
    // ('user_id'==auth()->id())->orderBy('name', 'ASC')->get(); // Filter roles by current user ID

    $roles = Role::where('id', '!=', 1)
    ->where(function($query) {
        $query->where('created_by', auth()->id())
              ->orWhereNull('created_by');
    })
    ->orderBy('role_name', 'ASC')
    ->get();

    // dd($roles);
    return view('panel.user-management.users.create', [
        'roles' => $roles,
    ]);
    
}


    /**
     * Store a newly created resource in storage.
     */
public function store(Request $request)
{
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
    $user->user_type = "companyEmployee";
    $user->created_by = auth()->id();
    $user->save();

    // Find role by role_name and assign it
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
    $user = User::findOrFail($id);
    $roles = Role::orderBy('role_name', 'ASC')->get();
    $hasRoles = $user->roles->pluck('role_name')->toArray(); // Get role names

    return view('panel.user-management.users.edit', [
        'user' => $user,
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
