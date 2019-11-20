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

   protected $primaryKey = "user_id";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id'
    ];

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
        return $this->belongsToMany('App\Lesson', 'lesson_student', 'student_id', 'lesson_id');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
