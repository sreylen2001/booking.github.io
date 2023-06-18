<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Bus;

class Schedule extends Model
{
    use HasFactory;
    protected $table = 'schedules';

    protected $fillable = [
        'id',
        'user_id',
        'bus_id',
        'driver_id',
        'region_id',
        'destination_id',
        'schedule_date',
        'departure_time',
        'estimated_arrival_time',
        'fee',
        'remarks',
        'status',
        'created_at',
        'update_at'
    ];
    public function user(){
        return $this->belongsTo(User::class);
    }

    public function bus(){
        return $this->belongsTo(Bus::class);
    }

    public function driver(){
        return $this->belongsTo(Driver::class);
    }

    public function region(){
        return $this->belongsTo(Region::class);
    }

    public function destination(){
        return $this->belongsTo(Destination::class);
    }
    
    public function scopeGettable()
    {
        return $this->table;
    }
}
