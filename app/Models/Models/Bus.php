<?php

namespace App\Models\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bus extends Model
{
    use HasFactory;

    protected $table = 'new_buses';

    protected $fillable = [
        'id',
        'user_id',
        'plate_number',
        'bus_type',
        'capacity',
        'book_seat',
        'status',
        'created_at',
        'update_at'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function new_bus_ticket(){
        return $this->hasOne(BusTicket::class);
    }

    public function scopeGettable()
    {
        return $this->table;
    }
}
