<?php

namespace App\Models\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $table = 'new_users';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'role_id',
        'name',
        'profile_photo',
        'email',
        'password',
        'phone',
        'dob',
        'gender',
        'status',
        'profession'
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

    public const USER_TOKEN = 'userToken';

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
    public function role(){
        return $this->belongsTo(Role::class);
    }

    public function getBirthDateAttribute($dates){
        return Carbon::createFromFormat('Y-m-d', $dates, $this->attributes['dob'])->format('m/d/Y');
    }
}
