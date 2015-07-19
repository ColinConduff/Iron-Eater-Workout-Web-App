<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SessionSet extends Model
{
	protected $table = 'sessionSets';

    protected $fillable = [
    	'session_id',
        'number_of_reps',
        'weight_lifted',
        'one_rep_max',
    ];

    public function session()
	{
		return $this->belongsTo('App\Session');
	}
}
