<?php

use Illuminate\Database\Seeder;
use Faker\Factory;

class ImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        File::cleanDirectory(public_path('storage/images/'));
        $faker = Factory::create();
        for($i = 0; $i < 10; $i++) {
            $faker->image(public_path('storage/images/'), $width = 1024, $height = 512);
        }

    }
}
