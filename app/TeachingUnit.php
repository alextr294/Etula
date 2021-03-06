<?php

namespace Étula;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TeachingUnit extends Model
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
      'name', 'group_id'
   ];

    /**
     * Get Lessons registered on this TeachingUnit
     *
     * @return HasMany
     */
    public function lessons()
    {
        return $this->hasMany('Étula\Lesson', 'unit_id');
    }

    /**
     * Get the Group available for this Lesson
     *
     * @return BelongsTo
     */
    public function group() {
        return $this->belongsTo('Étula\Group');
    }

}
