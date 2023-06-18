<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TravelSchedule extends Model
{
    use HasFactory;
    protected $table = 'travel_schedules';

    protected $fillable = [
        'id',
        'user_id',
        'bus_id',
        'driver_id',
        'starting_point',
        'destination',
        'schedule_date',
        'departure_time',
        'estimated_arrival_time',
        'fee',
        'remarks',
        'created_at',
        'update_at'
    ];


    public function scopeGettable()
    {
        return $this->table;
    }
}
