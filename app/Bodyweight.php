<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bodyweight extends Model
{
    protected $fillable = [
    	'user_id',
        'bodyweight',
        'bmi'
    ];
    
    public function user()
	{
		return $this->belongsTo('App\User');
	}
}
