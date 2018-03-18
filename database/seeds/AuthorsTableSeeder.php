<?php

use Illuminate\Database\Seeder;
use App\Author;

class AuthorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        $faker = \Faker\Factory::create();

        for ($i = 0; $i < 1000; $i++ ) {

            Author::create([
                'name' => $faker->firstname
            ]);

        }

    }
}
