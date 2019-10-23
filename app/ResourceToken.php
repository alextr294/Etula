<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ResourceToken extends Model
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
      'data', 'type', 'begin_at', 'end_at', 'longitude', 'latitude'
   ];
}
