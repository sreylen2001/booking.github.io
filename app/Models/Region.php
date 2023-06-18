<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    
    use HasFactory;
    protected $table = 'regions';

    protected $fillable = [
        'id',
        'region_name',
        'status',
        'created_at',
        'update_at'
    ];

    public function scopeGettable()
    {
        return $this->table;
    }
}
