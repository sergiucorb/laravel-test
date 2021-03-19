<?php

namespace Database\Seeders;

use App\Models\Post;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
//        Post::truncate();
        $posts = Post::find(1);
        if (!$posts) {
            $this->createFakerPosts();
        }
    }

    public function createFakerPosts()
    {
        $faker = Faker::create();
        foreach (range(1, 50000) as $index) {
            DB::table('posts')->insert([
                'title' => $faker->city,
                'user_id'=> rand(1, 100),
                'content' => $faker->paragraph,
                'active' => rand(0, 1),
                'created_at' => Carbon::now()->addSeconds($index),
            ]);
        }
    }
}
