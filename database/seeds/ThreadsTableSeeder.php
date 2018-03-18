<?php

use Illuminate\Database\Seeder;
use App\Thread;

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

        $faker = \Faker\Factory::create();

        for ($i = 0; $i < 50; $i++ ) {

            Thread::create([
                'title' => $faker->sentence,
                'image_url' => 'https://picsum.photos/200/200/?image=' . rand(1, 1080),
                'tag' => $faker->word,
                'author' => $faker->name,
                'score' => rand(1000, 20000)
            ]);
        }
    }
}
