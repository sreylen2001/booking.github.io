<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
    protected $table = 'customers';

    protected $fillable = [
        'id',
        'user_id',
        'name',
        'contact',
        'email',
        'username',
        'gender',
        'nationality',
        'status',
        'created_at',
        'update_at'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
    public $timestamps = false;

    public function scopeGettable()
    {
        return $this->table;
    }
}
