<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Paper extends Model
{
    protected $fillable = ["title", "abstract", "area", "topics", "status", "file", "camera_ready", "presentation", "authors"];

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

    public static function getAreaIndex($value) {
        return array_search($value->area, $value->conference->areas);
    }

    public function user() {
        return $this->belongsTo('App\User');
    }

    public function conference() {
        return $this->belongsTo('App\Model\Conference');
    }

    public function reviewers() {
        return $this->belongsToMany('App\User', 'reviewer_paper')
            ->withPivot(['comment_str', 'comment_weak', 'comment_reviewer', 'score', 'bpp_recommend']);
    }
}
