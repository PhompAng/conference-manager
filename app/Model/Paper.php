<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Paper extends Model
{
    protected $fillable = ["title", "topics", "file"];

    public function user() {
        return $this->belongsTo('App\User');
    }

    public function conference() {
        return $this->belongsTo('App\Model\Conference');
    }
}
