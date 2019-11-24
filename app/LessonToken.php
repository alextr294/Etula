<?php

namespace Étula;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LessonToken extends Model
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
      'token', 'longitude', 'latitude'
   ];

    /**
     * Get the Lesson which owns this LessonToken
     *
     * @return BelongsTo
     */
    public function lesson() {
        return $this->belongsTo('Étula\Lesson');
    }
}
