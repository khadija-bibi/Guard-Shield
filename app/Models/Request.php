<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Request extends Model
{
    protected $table = 'requests'; 

    protected $fillable = [
        'location_id',
        'area_zone_id',
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
    public function location()
    {
        return $this->belongsTo(Location::class, 'location_id');
    }
    public function area_zone()
    {
        return $this->belongsTo(AreaZone::class, 'area_zone_id');
    }
}
