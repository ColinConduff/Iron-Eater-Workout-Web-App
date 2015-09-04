<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Session extends Model
{
    protected $fillable = [
    	'user_id',
    	'workout_id',
        'exercise_id',
        'session_date'
    ];

    public function user()
	{
		return $this->belongsTo('App\User');
	}

	public function exercise()
	{
		return $this->belongsTo('App\Exercise');
	}

    public function sessionSets()
    {
        return $this->hasMany('App\SessionSet');
    }
}
