<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;
    protected $table = 'booking_cars';

    protected $fillable = [
        'id',
        'user_id',
        'schedule_id',
        'customer_id',
        'number_of_seats',
        'fare_amount',
        'total_amount',
        'booking_status',
        'status',
        'created_at',
        'update_at'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function schedule(){
        return $this->belongsTo(Schedule::class);
    }

    public function customer(){
        return $this->belongsTo(Customer::class);
    }
    public $timestamps = false;

    public function scopeGettable()
    {
        return $this->table;
    }
}
