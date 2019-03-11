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
$factory->define(App\Comment::class, function (Faker $faker) {
    $posts = App\Post::pluck('id')->toArray();
    return [
        'post_id' => $faker->randomElement($posts),
        'comment_name' => $faker->name(),
		'comment_email' => $faker->unique()->safeEmail,
        'comment_content' => $faker->realText(),
		'comment_date' => now(),
        
    ];
});