<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PlanExercise extends Model
{
    protected $table = 'planExercises';

    protected $fillable = [
        'planWorkout_id',
        'exercise_id',
        'weightToAddForSuccess',
        'weightToSubForFail'
    ];
    
    public function exercise()
	{
		return $this->belongsTo('App\Exercise');
	}

    public function planSets()
    {
        return $this->hasMany('App\PlanSet');
    }
}
