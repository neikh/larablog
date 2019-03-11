<?php
use Illuminate\Support\Str;
use Faker\Generator as Faker;
/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/
$factory->define(App\Post::class, function (Faker $faker) {
    $users = App\User::pluck('id')->toArray();
    return [
        'post_author' => $faker->randomElement($users),
        'post_date' => now(),
        'post_content' => $faker->realText(),
        'post_title' => $faker->realText(50),
        'post_name' => $faker->unique()->word(),
        'post_type' => 'article',
		'post_status' => 'published',
		'post_category' => $faker->word(),
    ];
});