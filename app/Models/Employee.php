<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $table = 'employees';

    protected $fillable = [
        'name',
        'phone',
        'address',
        'image',
        'user_id',
        'salary',
        'qualification',
        'designation',
        'created_by',
        'company_id', 
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    
    public function responses()
    {
        return $this->belongsToMany(Response::class, 'response_has_guards', 'employee_id', 'response_id');
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
    public function attendance()
    {
        return $this->hasMany(Attendance::class);
    }


}
