<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PlanDate extends Model
{
	protected $table = 'planDates';

    protected $fillable = [
    	'planWorkout_id',
        'futureWorkoutDate'
    ];
    
    public function planWorkout()
	{
		return $this->belongsTo('App\PlanWorkout');
	}
}
