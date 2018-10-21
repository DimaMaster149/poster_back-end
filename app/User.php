<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'first_name', 'last_name', 'user_country', 'user_city', 'email', 'password',
    ];


    protected $hidden = [
        'password', 'remember_token',
    ];

	public function events()
	{
		return $this->hasMany('App\Event', 'event_user', 'id');
	}

	protected $primaryKey = 'id';
}
