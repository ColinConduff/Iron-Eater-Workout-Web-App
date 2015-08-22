<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PlanSet extends Model
{
    protected $fillable = [
    	'plan_exercise_id',
        'expected_reps',
        'expected_weight'
    ];
    
    public function planExercise()
	{
		return $this->belongsTo('App\PlanExercise');
	}
}
