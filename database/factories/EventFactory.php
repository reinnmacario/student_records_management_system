<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use App\Event;
use Faker\Generator as Faker;
use Carbon\Carbon;
use Illuminate\Support\Facades\Config;

$factory->define(Event::class, function (Faker $faker) {
    $classification = ['Seminar', 'Workshop'];
    return [
        'name' => ucfirst($faker->word(6)) . " Event",
        'description' => implode($faker->sentences()),
        'ereserve_id' => $faker->randomNumber(6),
        'academic_year' => $faker->numberBetween(2015, 2019),
        'semester' => "2nd Semester",
        'classification' => $classification[array_rand($classification)],
        'status' => Config::get('constants.event_status.socc_approval'),
        'read_status' => Config::get('constants.read_status.unread'),
        'date_start' => Carbon::now(),
        'created_at' => Carbon::now(),
        'updated_at' => Carbon::now(),
    ];
});
