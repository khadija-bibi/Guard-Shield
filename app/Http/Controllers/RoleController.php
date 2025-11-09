<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Validator;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
class RoleController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return[
            // new Middleware('permission:view roles', only: ['index']),
            // new Middleware('permission:edit roles', only: ['edit']),
            // new Middleware('permission:create roles', only: ['create']),
            // new Middleware('permission:delete roles', only: ['destroy']),
        ];
    }
   
    public function index()
    {
        $user = auth()->user();

        if ($user->user_type === 'superAdmin') {
            $adminEmployeeIds = User::where('user_type', 'adminEmployee')->pluck('id');

            $roles = Role::with('permissions')
                ->where(function ($query) use ($user, $adminEmployeeIds) {
                    $query->where('created_by', $user->id)
                        ->orWhereIn('created_by', $adminEmployeeIds);
                })
                    ->latest()
                    ->paginate(4);
        }else if ($user->user_type === 'adminEmployee') {
            $superAdminIds = User::where('user_type', 'superAdmin')->pluck('id');

            $roles = Role::with('permissions')
                ->where(function ($query) use ($user, $superAdminIds) {
                    $query->where('created_by', $user->id)
                        ->orWhereIn('created_by', $superAdminIds);
                })
                ->latest()
                ->paginate(4);
        }else if ($user->user_type === 'companyOwner') {
            $companyEmployeeIds = User::where('user_type', 'companyEmployee')->where('created_by', auth()->user()->id)->pluck('id');

            $roles = Role::with('permissions')
                ->where(function ($query) use ($user, $companyEmployeeIds) {
                    $query->where('created_by', $user->id)
                        ->orWhereIn('created_by', $companyEmployeeIds);
                })
                ->latest()
                ->paginate(4);
        }else if ($user->user_type === 'companyEmployee') {

            $roles = Role::with('permissions')
                ->where(function ($query) use ($user) {
                    $query->where('created_by', $user->id)
                        ->orWhere('created_by', $user->created_by);
                })
                ->latest()
                ->paginate(4);
        } else {
            // Optional: Fallback for non-superAdmin users
            $roles = Role::with('permissions')
                ->where('created_by', $user->id)
                ->paginate(4);
        }

        return view('panel.user-management.roles.index', [
            'roles' => $roles
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $permissions = Permission::orderBy('name','ASC')->get();
        return view('panel.user-management.roles.create',[
            'permissions'=> $permissions
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
    
            $validator = Validator::make($request->all(), [
                'name' => [
                    'required',
                    'string',
                    'max:255',
                    Rule::unique('roles', 'role_name')->where(function ($query) {
                        return $query->where('created_by', auth()->id());
                    }),
                ],

                'permissions' => 'required|array',
                'permissions.*' => 'string|exists:permissions,name',
            ]);
            
            if ($validator->fails()) {
            return back()->withInput()->withErrors($validator);
        }


        $role_name=str()->random(5).$request->name;
        $role = Role::create([
            'name' => $role_name,
            'role_name' => $request->name,
            'created_by' =>auth()->id(),
        ]);
        if (!empty($request->permissions) && is_array($request->permissions)) {
            $permissions = Permission::whereIn('name', $request->permissions)->get();
            $role->syncPermissions($permissions);
        }
        return redirect()->back()->with('success', 'Role created successfully!');
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
    public function edit(string $id)
    {
        $role = Role::findOrFail($id);
        $hasPermissions=$role->permissions->pluck('name');
        $permissions = Permission::orderBy('name','ASC')->get();
        return view('panel.user-management.roles.edit',[
            'permissions'=> $permissions,
            'hasPermissions'=>$hasPermissions,
            'role'=>$role
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
{
    $role = Role::findOrFail($id);

    $validator = Validator::make($request->all(), [
        'name' => 'required|unique:roles,role_name,' . $id . ',id|min:3',
        'permission' => 'required|array|min:1',
        'permission.*' => 'string|exists:permissions,name',
    ], [
        'permission.required' => 'At least one permission is required.',
    ]);

    if ($validator->fails()) {
        return redirect()->route('roles.edit', $id)
                         ->withInput()
                         ->withErrors($validator);
    }

    $role->role_name = $request->name;
    $role->save();

    $role->syncPermissions($request->permission);

    return redirect()->route('roles.index')->with('success', 'Role updated successfully!');
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $role = Role::findOrFail(decrypt($id));
        $role->delete();
        return redirect()->route('roles.index')->with('success', 'Role deleted successfully!');
    }
}
