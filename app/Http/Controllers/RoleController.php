<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // public function index()
    // {
    //     $roles=Role::with('permissions')->get();
    //     return view('panel.user-management.roles.index',[
    //         'roles'=>$roles
    //     ]);
       

    // }
    public function index()
{
    $roles = Role::with('permissions')
        ->where('created_by', auth()->id()) 
        ->paginate(4); 

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
                'name' => 'required|string|max:255|unique:roles,name',
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
            $permissions = Permission::whereIn('name', $request->permissions)->get();
            $role->syncPermissions($permissions);
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
        $validator = Validator::make($request->all(),[
            'name' => 'required|unique:roles,name,'.$id.',id|min:3'
        ]);

        if($validator->passes()){
            $role->role_name = $request->name;
            $role->save();

            if(!empty($request->permission)){
                $role->syncPermissions($request->permission);
            }
            else{
                $role->syncPermissions([]);

            }
            return redirect()->route('roles.index')->with('success','Role updated successfully');

        }
        else{
            return redirect()->route('roles.edit',$id)->withInput()->withErrors($validator);
        }
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
