<?php

namespace Étula;

use Illuminate\Database\Eloquent\Relations\HasOne;
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
        'name', 'email', 'password', 'type'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * @return HasOne
     */
    public function studentAccess() {
        return $this->hasOne('Étula\Student');
    }

    /**
     * @return HasOne
     */
    public function teacherAccess() {
        return $this->hasOne('Étula\Teacher');
    }

    /**
     * @return HasOne
     */
    public function adminAccess() {
        return $this->hasOne('Étula\Admin');
    }

    /**
     * Check if user is admin
     *
     */
    public function isAdmin() {
        return $this->type == "admin";
    }

    /**
     * Check if user is admin
     *
     */
    public function isStudent() {
        return $this->type == "student";
    }

    /**
     * Check if user is admin
     *
     */
    public function isTeacher() {
        return $this->type == "teacher";
    }
}
