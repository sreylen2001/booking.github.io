<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;
    protected $table = 'payments';

    protected $fillable = [
        'id',
        'user_id',
        'booking_buses_id',
        'amount_paid',
        'payment_date',
        'created_at',
        'update_at'
    ];


    public function scopeGettable()
    {
        return $this->table;
    }
}
