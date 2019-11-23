<?php

namespace Étula;

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
     * Get Lessons owned by this Teacher
     *
     * @return HasMany
     */
    public function ownedLessons()
    {
        return $this->hasMany('Étula\Lesson');
    }

    /**
     * Get Lessons supervised by this Teacher
     *
     * @return BelongsToMany
     */
    public function supervisedLessons()
    {
        return $this->belongsToMany('Étula\Lesson', 'lesson_teacher', 'teacher_id', 'lesson_id');
    }

    public function user()
    {
        return $this->belongsTo('Étula\User');
    }
}
