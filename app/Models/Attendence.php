<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendence extends Model
{
    use HasFactory;

    protected $table = 'attendence';

    protected $fillable = [
        'employee_id',
        'clock_in',
        'clock_out',
        'working_hours',
        'overtime_hours',
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

}
