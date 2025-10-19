<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Request extends Model
{
    protected $table = 'requests'; 

    protected $fillable = [
        'location_address',
        'location_lat',
        'location_lng',
        'crewtype',
        'description',
        'severity',
        'date_from',
        'date_to',
        'time_from',
        'time_to',
        'users_id',
        'paymentPlan',
        'budget',
        'status',
        'company_id', 
    ];

    
    public function user()
    {
        return $this->belongsTo(User::class, 'users_id');
    }
    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id');
    }
}
