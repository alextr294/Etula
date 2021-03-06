<?php

namespace Étula;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

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
        return $this->belongsToMany('Étula\Group');
    }

    /**
     * Get Lessons in which the student confirmed to be there
     *
     * @return BelongsToMany
     */
    public function presentLessons()
    {
        return $this->belongsToMany('Étula\Lesson', 'lesson_student', 'student_id', 'lesson_id');
    }

    public function user()
    {
        return $this->belongsTo('Étula\User');
    }
}
