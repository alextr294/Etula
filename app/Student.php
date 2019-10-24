<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Student extends Model
{
   /**
    * Indicates if the model should be timestamped.
    *
    * @var bool
    */
   public $timestamps = false;

    /**
     * Get Groups from this Student
     *
     * @return BelongsToMany
     */
    public function groups()
    {
        return $this->belongsToMany('App\Group');
    }

    /**
     * Get Lessons in which the student confirmed to be there
     *
     * @return BelongsToMany
     */
    public function presentLessons()
    {
        return $this->belongsToMany('App\Lesson');
    }
}
