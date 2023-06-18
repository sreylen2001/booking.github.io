<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Driver extends Model
{
    use HasFactory;
    protected $table = 'drivers';

    protected $fillable = [
        'id',
        'user_id',
        'name',
        'contact',
        'bus_type',
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
