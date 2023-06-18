<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Destination extends Model
{
    use HasFactory;
    protected $table = 'destinations';

    protected $fillable = [
        'id',
        'destination_name',
        'status',
        'created_at',
        'update_at'
    ];


    public function scopeGettable()
    {
        return $this->table;
    }
}
