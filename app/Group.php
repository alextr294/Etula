<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Group extends Model
{
    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name'
    ];

    /**
     * Get Students from this Group
     *
     * @return BelongsToMany
     */
    public function students()
    {
        return $this->belongsToMany('App\Student', 'group_student', 'group_id', 'student_id');
    }

    /**
     * Get TeachingUnits for this Group
     *
     * @return HasMany
     */
    public function units() {
        return $this->hasMany('App\TeachingUnit');
    }
}
