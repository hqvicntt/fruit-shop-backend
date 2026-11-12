<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    // Allow mass assignment for these columns
    protected $fillable = [
        'total_amount',
        'cash_amount',
        'transfer_amount',
        'items_summary',
    ];
}
