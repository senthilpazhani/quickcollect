<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Systemsetting extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'dateformat', 'country', 'currencysymbol', 'currencysymbolplacement','decimalplace','listitems','companytitle','companylogo','bcc', 'status', 'created_by', 'modified_by', 'created_at', 'updated_at', 'visitor'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'created_at', 'updated_at', 'created_by', 'modified_by', 'visitor'
    ];
    /*
    public function sendEmailVerificationNotification(){
        $this->notify(new CustomNotification);
    }
    */
}
