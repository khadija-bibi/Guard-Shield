<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class EmployeeController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return[
            new Middleware('permission:view employees', only: ['index']),
            new Middleware('permission:edit employees', only: ['edit']),
            new Middleware('permission:create employees', only: ['create']),
            new Middleware('permission:delete employees', only: ['destroy']),
        ];
    }
    public function index()
    {
        $userCompanyId = auth()->user()->company_id;
        $employees = Employee::where('company_id', $userCompanyId)
                            ->latest()
                            ->paginate(5);
        
        
        return view('panel.HRM.employees.index', [
            'employees' => $employees,
        ]);
    }
    public function detail(String $id)
    {
        $employee = Employee::with('user')->findOrFail($id);

        return view('panel.HRM.employees.detail', [
            'employee' => $employee,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $companyId = auth()->user()->company_id;
    $users = User::where('company_id', $companyId)
             ->where('user_type', '!=', 'companyOwner')
             ->get();


    return view('panel.HRM.employees.create', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'address' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpg,png,jpeg|max:5120',
            'salary' => 'required|numeric',
            'qualification' => 'required|string|max:255',
            'designation' => 'required|string|max:255',
            'user_id' => 'nullable|exists:users,id',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('uploads/employees', 'public');
        }

        Employee::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'address' => $request->address,
            'image' => $imagePath,
            'salary' => $request->salary,
            'qualification' => $request->qualification,
            'designation' => $request->designation,
            'user_id' => $request->user_id,
            'created_by'=> auth()->user()->id,
            'company_id' => auth()->user()->company_id, 
        ]);

        return redirect()->route('employees.index')->with('success', 'Employee created successfully!');
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
        $employee = Employee::findOrFail($id);

        $companyId = auth()->user()->company_id;
        $users = User::where('company_id', $companyId)
                    ->where('user_type', '!=', 'companyOwner')
                    ->get();

        return view('panel.HRM.employees.edit', compact('employee', 'users'));
    }

    public function update(Request $request, string $id)
    {
        $employee = Employee::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'address' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpg,png,jpeg|max:5120',
            'salary' => 'required|numeric',
            'qualification' => 'required|string|max:255',
            'designation' => 'required|string|max:255',
            'user_id' => 'nullable|exists:users,id',
        ]);

        // Handle image update
        if ($request->hasFile('image')) {
            // delete old image if exists
            if ($employee->image && Storage::disk('public')->exists($employee->image)) {
                Storage::disk('public')->delete($employee->image);
            }

            $employee->image = $request->file('image')->store('uploads/employees', 'public');
        }

        // Update fields
        $employee->update([
            'name' => $request->name,
            'phone' => $request->phone,
            'address' => $request->address,
            'salary' => $request->salary,
            'qualification' => $request->qualification,
            'designation' => $request->designation,
            'location' => $request->location,
            'user_id' => $request->user_id,
        ]);

        return redirect()->route('employees.index')->with('success', 'Employee updated successfully!');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $employee = Employee::findOrFail(decrypt($id));
        $employee->delete();
        return redirect()->route('employees.index')->with('success', 'Employee deleted successfully!');
    }
}
