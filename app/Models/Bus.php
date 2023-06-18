<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bus extends Model
{
    use HasFactory;
    protected $table = 'buses';

    protected $fillable = [
        'id',
        'user_id',
        'bus_number',
        'bus_plate_number',
        'bus_type',
        'status',
        'capacity',
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
