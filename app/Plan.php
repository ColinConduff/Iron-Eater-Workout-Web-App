<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    protected $fillable = [
    	'user_id',
    	'title',
        'start_date',
        'end_date'
    ];
    
    public function user()
	{
		return $this->belongsTo('App\User');
	}

	public function planWorkouts()
    {
        return $this->hasMany('App\PlanWorkout');
    }
}
