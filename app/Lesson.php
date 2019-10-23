<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
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
      'name', 'type', 'begin_at', 'end_at', 'longitude', 'latitude'
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
}
