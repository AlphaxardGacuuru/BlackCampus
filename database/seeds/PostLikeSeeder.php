<?php

use Illuminate\Database\Seeder;

class PostLikeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\PostLikes::class, 100)->create();
    }
}
