<?php

namespace App\Models\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BusTicket extends Model
{
    use HasFactory;

    protected $table = 'new_bus_tickets';

    protected $fillable = [
        'id',
        'bus_id',
        'from',
        'to',
        'fare_amount',
        'departure_time',
        'estimated_arrival_time',
        'status',
        'created_at',
        'update_at'
    ];
    public function new_buses(){
        return $this->belongsTo(Bus::class);
    }
    public function new_users(){
        return $this->belongsTo(User::class);
    }

    public function scopeGettable()
    {
        return $this->table;
    }
}
