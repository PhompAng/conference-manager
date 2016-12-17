<?php

namespace App\Model;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Conference extends Model
{
    protected $fillable = [
        'name', 'url', 'open', 'close', 'paper_deadline', 'acceptance', 'camera_deadline', 'pre_regis',
    ];

    public function users() {
        return $this->hasMany('App\User');
    }

    public function papers() {
        return $this->hasMany('App\Model\Paper');
    }

    public function getOpenAttribute($value) {
        return is_null($value) ? null:Carbon::parse($value)->format('Y-m-d\TH:i:s');
    }

    public function setOpenAttribute($value) {
        $this->attributes['open'] = Carbon::parse($value);
    }

    public function getCloseAttribute($value) {
        return is_null($value) ? null:Carbon::parse($value)->format('Y-m-d\TH:i:s');
    }

    public function setCloseAttribute($value) {
        $this->attributes['close'] = Carbon::parse($value);
    }

    public function getPaperDeadlineAttribute($value) {
        return is_null($value) ? null:Carbon::parse($value)->format('Y-m-d\TH:i:s');
    }

    public function setPaperDeadlineAttribute($value) {
        $this->attributes['paper_deadline'] = Carbon::parse($value);
    }

    public function getAcceptanceAttribute($value) {
        return is_null($value) ? null:Carbon::parse($value)->format('Y-m-d\TH:i:s');
    }

    public function setAcceptanceAttribute($value) {
        $this->attributes['acceptance'] = Carbon::parse($value);
    }

    public function getCameraDeadlineAttribute($value) {
        return is_null($value) ? null:Carbon::parse($value)->format('Y-m-d\TH:i:s');
    }

    public function setCameraDeadlineAttribute($value) {
        $this->attributes['camera_deadline'] = Carbon::parse($value);
    }

    public function getPreRegisAttribute($value) {
        return is_null($value) ? null:Carbon::parse($value)->format('Y-m-d\TH:i:s');
    }

    public function setPreRegisAttribute($value) {
        $this->attributes['pre_regis'] = Carbon::parse($value);
    }
}
