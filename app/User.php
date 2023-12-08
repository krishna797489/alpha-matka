<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\history;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use Notifiable;

    public function profile()
{
    return $this->hasOne(User::class);
}
public function histories()
{
    return $this->hasMany(History::class, 'user_id');
}

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'users';
    protected $fillable = [
        'name', 'email', 'password', 'phone','mpin',
    ];


    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
