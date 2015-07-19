<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Exercise extends Model
{
    protected $fillable = [
    	'user_id',
        'title',
        'best_one_rep_max',
        'type',
        'category'
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
