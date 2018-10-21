<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class State extends Model
{
	protected $fillable = [
		'state_name'
	];

	protected $primaryKey = 'state_id';
}
