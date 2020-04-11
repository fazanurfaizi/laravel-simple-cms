<?php

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\News;
use Faker\Factory;

class NewsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();
        $users = User::select('id')->get();
        $images = File::allFiles(public_path('storage/images'));

        foreach (range(0, 5) as $value) {
            $title = $faker->sentence;
            $slug = str_slug($title);
            News::create([
                'title' => $title,
                'slug' => $slug,
                'body' => $faker->paragraph(10),
                'user_id' => $users->random()->id,
                'image' => $images[$value]->getFilename(),
                'views' => rand(0, 100)
            ]);
        }
    }
}
