<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PlanExercise extends Model
{
    protected $fillable = [
        'plan_workout_id',
        'exercise_id',
        'weight_to_add_for_success',
        'weight_to_sub_for_fail'
    ];
    
    public function exercise()
	{
		return $this->belongsTo('App\Exercise');
	}

    public function planWorkout()
    {
        return $this->belongsTo('App\PlanWorkout');
    }

    public function planSets()
    {
        return $this->hasMany('App\PlanSet');
    }
}
