<?php

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       factory(App\User::class, 75)
				->create()
				->each(function ($user) {
						$user->posts()
								->save(factory(App\Post::class, 75)
								->create()
								->each(function ($post) {
										$post->comments()
												->save(factory(App\Comment::class)
												->make());
								}));
				});
	}
}