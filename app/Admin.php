<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
   /**
    * Indicates if the model should be timestamped.
    *
    * @var bool
    */
   public $timestamps = false;

   public function user()
   {
       return $this->belongsTo('App\User');
   }
}
