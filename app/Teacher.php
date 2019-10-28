<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Teacher extends Model
{
   /**
    * Indicates if the model should be timestamped.
    *
    * @var bool
    */
   public $timestamps = false;

    /**
     * Get Lessons owned by this Teacher
     *
     * @return HasMany
     */
    public function ownedLessons()
    {
        return $this->hasMany('App\Lesson');
    }

    /**
     * Get Lessons supervised by this Teacher
     *
     * @return BelongsToMany
     */
    public function supervisedLessons()
    {
        return $this->belongsToMany('App\Lesson');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
