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

    public static function getTitle($value) {
        switch ($value) {
            case 1:
                return "Dr.";
            case 2:
                return "Mr.";
            case 3:
                return "Ms.";
            case 4:
                return "Mrs.";
        }
    }

    public static function getAcademicPosition($value) {
        switch ($value) {
            case 1:
                return "Prof.";
            case 2:
                return "Assoc. Prof.";
            case 3:
                return "Asst. Prof.";
            case 4:
                return "";
        }
    }

    public static function getRole($value) {
        switch ($value) {
            case 1:
                return "Author";
            case 2:
                return "Reviewer";
            case 3:
                return "TPC";
            default:
                return "";
        }
    }

    public function conference() {
        return $this->belongsTo('App\Model\Conference');
    }

    public function papers() {
        return $this->hasMany('App\Model\Paper');
    }
}
