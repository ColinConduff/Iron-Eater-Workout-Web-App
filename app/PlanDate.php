<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PlanDate extends Model
{
    protected $fillable = [
    	'plan_workout_id',
        'planned_date'
    ];
    
    public function planWorkout()
	{
		return $this->belongsTo('App\PlanWorkout');
	}
}
