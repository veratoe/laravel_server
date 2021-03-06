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
        // moet met delete vanwege foreign key constraint
        DB::table('threads')->delete();
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


            for ($j = 0; $j < rand(1, 5); $j++) {

                Comment::create([
                    'thread_id' => $thread->id,
                    'user_id' => rand(1, 1000),
                    'content' => $faker->sentence,
                    'type' => 'user'
                ]);
            }
        }
    }
}
