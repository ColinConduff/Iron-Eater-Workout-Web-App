<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Workout extends Model
{
    protected $fillable = [
    	'user_id',
        'title',
        'note'
    ];

    public function user()
	{
		return $this->belongsTo('App\User');
	}

    public function sessions()
    {
        return $this->hasMany('App\Session');
    }
}
