<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'academic_position', 'name', 'family_name', 'affiliation', 'country', 'mobile', 'fax', 'username', 'role', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function conference() {
        return $this->belongsTo('App\Model\Conference');
    }

    public function papers() {
        return $this->hasMany('App\Model\Paper');
    }
}
