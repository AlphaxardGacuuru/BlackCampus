<?php

use Illuminate\Database\Seeder;

class PollSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Posts::class, 100)->create()->each(function ($post) {
            $post->polls()->save(factory(App\Polls::class)->make([
				'parameter' => $post->parameter_1
			]));
        });
    }
}
