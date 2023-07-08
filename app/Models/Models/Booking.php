<?php

namespace App\Models\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $table = 'new_bookings';

    protected $fillable = [
        'id',
        'user_id',
        'bus_id',
        'number_of_seats',
        'total_amount',
        'status',
        'created_at',
        'update_at'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function new_buses(){
        return $this->belongsTo(Bus::class);
    }

    public $timestamps = false;

    public function scopeGettable()
    {
        return $this->table;
    }
}
