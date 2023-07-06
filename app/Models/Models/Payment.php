<?php

namespace App\Models\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;
    protected $table = 'new_payments';

    protected $fillable = [
        'id',
        'user_id',
        'booking_ticket_id',
        'payment_amount',
        'payment_by',
        'status',
        'created_at',
        'update_at'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function scopeGettable()
    {
        return $this->table;
    }
}
