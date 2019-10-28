<?php

namespace App;

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
        return $this->hasOne('App\Student');
    }

    /**
     * @return HasOne
     */
    public function teacherAccess() {
        return $this->hasOne('App\Teacher');
    }

    /**
     * @return HasOne
     */
    public function adminAccess() {
        return $this->hasOne('App\Admin');
    }

    /**
     * Retrieve rank for the user, given his type ($this->access())
     *
     * @param $query
     * @return mixed
     */
    /*public function scopeAccess($query)
    {
        return $query
            ->when($this->type === 'student',function($q){
                return $q->with('studentAccess');
            })
            ->when($this->type === 'teacher',function($q){
                return $q->with('teacherAccess');
            })
            ->when($this->type === 'admin',function($q){
                return $q->with('adminAccess');
            });
    }*/

    /**
     * Check if user is admin
     *
     */
    public function isAdmin() {
        return ($this->type=="admin");
    }
}
