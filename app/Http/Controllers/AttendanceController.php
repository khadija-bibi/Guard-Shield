<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Attendance;

use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    public function index()
    {
        $userCompanyId = auth()->user()->company_id;
        $employees = Employee::where('company_id', $userCompanyId)
                    ->where('designation', 'guard')
                    ->latest()
                    ->paginate(5);

        return view('panel.HRM.attendance.index', [
            'employees' => $employees,
        ]);  
    }
    public function show($employee_id)
    {
        $attendance = Attendance::where('employee_id', $employee_id)
                                ->latest()
                                ->paginate(10);

        return view('panel.HRM.attendance.attendance', [
            'attendance' => $attendance
        ]);
    }
}
