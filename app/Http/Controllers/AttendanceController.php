<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Attendance;
use App\Models\Attendence;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
class AttendanceController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return[
            new Middleware('permission:view attendance', only: ['index','show']),
        ];
    }

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
        $attendance = Attendence::where('employee_id', $employee_id)
                                ->latest()
                                ->paginate(10);

        return view('panel.HRM.attendance.attendance', [
            'attendance' => $attendance
        ]);
    }
}
