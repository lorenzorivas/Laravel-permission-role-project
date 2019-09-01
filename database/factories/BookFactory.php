<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Book;
use App\User;
use Faker\Generator as Faker;

$factory->define(Book::class, function (Faker $faker) {
    return [
        'user_id' => User::all()->random()->id,
        'title' => $faker->text(50),
        'slug' => str_slug($faker->text(50)),
        'excerpt' => $faker->realText(150),
        'published' => $faker->boolean,
        'picture' => $faker->imageUrl($width = 700, $height = 1000),
    ];
});