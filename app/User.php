<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'email', 'password','phone','balance',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function isAdmin()
    {
        if ($this->role == 2) return true;

        return false;
    }

    public function projects()
    {
        return $this->belongsTo('App\Project');
    }

    public function topups()
    {
        return $this->belongsTo('App\Topup');
    }
    
    public function transactions()
    {
        return $this->belongsTo('App\Transaction');
    }
}
