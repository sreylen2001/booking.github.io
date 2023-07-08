<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'profession',
        'profile_photo',
        'dob',
        'phone_number',
        'gender',
        'status'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function setBirthDateAttribute($dates){
        $this->attributes['dob'] = Carbon::createFromFormat('m/d/Y', $dates)->format('Y-m-d');

    }

    public function getBirthDateAttribute($dates){
        return Carbon::createFromFormat('Y-m-d', $dates, $this->attributes['dob'])->format('m/d/Y');
    }
}
