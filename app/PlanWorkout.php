<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PlanWorkout extends Model
{
    protected $fillable = [
    	'plan_id',
        'workout_id'
    ];
    
    public function plan()
	{
		return $this->belongsTo('App\Plan');
	}

    public function workout()
    {
        return $this->belongsTo('App\Workout');
    }

	public function planDates()
    {
        return $this->hasMany('App\PlanDate');
    }

    public function planExercises()
    {
        return $this->hasMany('App\PlanExercise');
    }
}
