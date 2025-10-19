<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Response extends Model
{
    use HasFactory;

    protected $fillable = [
        'request_id',
        'company_id',
        'description',
        'quotation',
    ];

    // Relationships
    public function request()
    {
        return $this->belongsTo(Request::class);
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }
    public function employees()
    {
        return $this->belongsToMany(Employee::class, 'response_has_guards', 'response_id', 'employee_id')->withTimestamps();
    }
}
