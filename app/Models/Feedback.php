<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    use HasFactory;

    protected $table = 'feedbacks';

    protected $fillable = [
        'request_id',
        'user_id',
        'company_id',
        'comment',
        'rating', 
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    
    public function request()
    {
        return $this->belongsTo(Request::class);
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
