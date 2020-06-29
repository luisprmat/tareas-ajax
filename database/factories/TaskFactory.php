<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Task;
use Faker\Generator as Faker;

$factory->define(Task::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence(3)
    ];
});

$factory->state(Task::class, 'pending', ['status' => 'pending']);

$factory->state(Task::class, 'completed', ['status' => 'completed']);
