<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
     use HasFactory;

    /**
     * Table associated with the model.
     * By default Laravel assumes table name = plural of model ('invoices'), so this is optional.
     */
    protected $table = 'invoices';

    /**
     * Mass assignable attributes.
     */
    protected $fillable = [
        'request_id',          // Jo request ke against invoice generate hui
        'total_days',          // Total days of service period
        'month_count',         // Total months calculated from total_days
        'amount',              // Monthly invoice amount
        'billing_start_date',  // Start date of this invoice period
        'billing_end_date',    // End date of this invoice period
        'attachment',          // Optional invoice PDF/file
        'status',              // Invoice status: PENDING / PAID / OVERDUE
    ];

    /**
     * Cast attributes to proper data types
     */
    protected $casts = [
        'billing_start_date' => 'date',
        'billing_end_date'   => 'date',
        'amount'             => 'decimal:2',
    ];

    /**
     * Relationships
     */

    // Invoice belongs to a single request
    public function request()
    {
        return $this->belongsTo(Request::class);
    }
}
