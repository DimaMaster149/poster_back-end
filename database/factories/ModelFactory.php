<?php

use Faker\Generator as Faker;
use App\Event;
use App\State;
use App\User;

$factory->define(Event::class, function (Faker $faker) {
	return [
		'event_state' =>State::all()->random()->state_id,
		'event_date' => $faker->dateTimeBetween($startDate = '-5 days', $endDate = 'now', $timezone = null),
		'event_time' => $faker->time(),
		'event_user' => User::all()->random()->id,
		'event_title' => $faker->company,
		'event_description' => $faker->text(250),
		'event_image' => $faker->image(public_path().'\images',200, 200, 'cats', false),
		'event_location' => $faker->streetAddress,
	];
});

