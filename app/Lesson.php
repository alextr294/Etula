<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Lesson extends Model
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
      'name', 'type', 'begin_at', 'end_at', 'unit_id', 'teacher_id'
   ];

    /**
     * Get the TeachingUnit of this Lesson
     *
     * @return BelongsTo
     */
    public function unit() {
        return $this->belongsTo('App\TeachingUnit');
    }

    /**
     * Get the Teacher who owns this Lesson
     *
     * @return BelongsTo
     */
    public function owner() {
        return $this->belongsTo('App\Teacher');
    }

    /**
     * Get the LessonToken available for this Lesson
     *
     * @return HasOne
     */
    public function token() {
        return $this->hasOne('App\LessonToken');
    }

    /**
     * Get Students that confirmed their presence in this Lesson
     *
     * @return BelongsToMany
     */
    public function presentStudents()
    {
        return $this->belongsToMany('App\Student', 'lesson_student', 'lesson_id', 'student_id');
    }

    /**
     * Teachers
     */
    public function teachers()
    {
        return $this->belongsToMany('App\Teacher', 'lesson_teacher', 'lesson_id', 'teacher_id');
    }
}
