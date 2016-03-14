<?php

use Illuminate\Database\Seeder;

class SociTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $faker = Faker\Factory::create();


        $faker->email;
        bcrypt('secret');
    }
}
