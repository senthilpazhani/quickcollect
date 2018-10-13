<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Smtp extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'host', 'port', 'username', 'password','encryption', 'status', 'created_by', 'modified_by', 'created_at', 'updated_at', 'visitor'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',  'created_at', 'updated_at', 'created_by', 'modified_by', 'visitor'
    ];
    /*
    public function sendEmailVerificationNotification(){
        $this->notify(new CustomNotification);
    }
    */
}
