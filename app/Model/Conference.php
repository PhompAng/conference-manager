<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Conference extends Model
{
    protected $fillable = [
        'name', 'url',
    ];

    public function users() {
        return $this->hasMany('App\User');
    }

    public function papers() {
        return $this->hasMany('App\Model\Paper');
    }
}
