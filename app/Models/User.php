<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable {
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'username',
        'email',
        'password',
        'phone',
        'user_firstname',
        'user_lastname',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getFullNameAttribute()
    {
        return "{$this->user_firstname} {$this->user_lastname}";
    }

    public function user_role()
    {
        return $this->belongsTo(Role::class, 'user_group');
    }

    public function u_region()
    {
        return $this->belongsTo(Region::class, 'user_region');
    }

    public function u_gender()
    {
        return $this->belongsTo(Gender::class, 'user_gender');
    }

    public function u_relationship()
    {
        return $this->belongsTo(Relationship::class, 'user_relationship');
    }
}
