<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
	protected $fillable = [
		'event_title', 'event_description', 'event_image', 'event_date', 'event_time', 'event_location', 'event_state', 'event_user', 'email', 'password',
	];

	public function user()
	{
		return $this->belongsTo('App\User', 'event_user', 'id');
	}

	public function state()
	{
		return $this->hasOne('App\State', 'event_state', 'event_id');
	}
	protected $primaryKey = 'event_id';
}
