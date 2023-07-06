<?php

namespace App\Models\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;
    protected $table = 'new_roles';

    protected $fillable = [
        'id',
        'name',
        'description',
        'created_at',
        'update_at'
    ];

    public function scopeGettable()
    {
        return $this->table;
    }
}
