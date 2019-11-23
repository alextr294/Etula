<?php

namespace Étula;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
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

    public function user()
    {
        return $this->belongsTo('Étula\User');
    }
}
