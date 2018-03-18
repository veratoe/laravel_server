<?php

use Illuminate\Database\Seeder;
use App\Thread;
use App\Comment;

class ThreadsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Thread::truncate();
        Comment::truncate();

        $faker = \Faker\Factory::create();

        for ($i = 0; $i < 50; $i++ ) {

            $thread = Thread::create([
                'title' => $faker->sentence,
                'image_url' => 'https://picsum.photos/200/200/?image=' . rand(1, 1080),
                'tag' => $faker->word,
                'author' => $faker->name,
                'score' => rand(1000, 20000)
            ]);


            for ($j = 0; $j < rand(1, 100); $j++) {

                Comment::create([
                    'thread_id' => $thread->id,
                    'author_id' => rand(1, 1000),
                    'content' => $faker->sentence
                ]);
            }
        }
    }
}
