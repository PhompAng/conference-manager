<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Paper extends Model
{
    protected $fillable = ["title", "abstract", "topics", "status", "file", "presentation", "authors"];

    public function getTopicsAttribute($value) {
        return json_decode($value, true);
    }

    public function setTopicsAttribute($value) {
        $this->attributes['topics'] = json_encode($value, JSON_UNESCAPED_UNICODE);
    }

    public function getAuthorsAttribute($value) {
        return json_decode($value, true);
    }

    public function setAuthorsAttribute($value) {
        $this->attributes['authors'] = json_encode($value, JSON_UNESCAPED_UNICODE);
    }

    public function user() {
        return $this->belongsTo('App\User');
    }

    public function conference() {
        return $this->belongsTo('App\Model\Conference');
    }
}
