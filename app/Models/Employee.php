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
        'salary_type',
        'qualification',
        'designation',
        'location',
        'clock_in',
        'clock_out',
        'company_id', // MUST ADD
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
