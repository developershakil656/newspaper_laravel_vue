<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Post;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $faker = Faker\Factory::create();

        // foreach (range(1, 50) as $index) {
        //     Post::create([
        //         "user_id"     => rand(1, 20),
        //         "category_id" => rand(1, 5),
        //         "title"       => $faker->sentence,
        //         "content"     => $faker->paragraph,
        //         "thumbnail"   => $faker->imageUrl(),
        //         "status"      => $this->getRandomStatus(),
        //     ]);
        // }

        foreach (range(1, 6) as $index) {
            $title=randomTitle($index-1);
                Post::create([
                    "user_id"     => rand(1, 5),
                    "category_id" => rand(1, 5),
                    "title"       => $title,
                    "slug"       => slugify($title),
                    "content"     => randomContent(rand(0, 5)),
                    "status"      => $this->getRandomStatus(),
                ]);
            }
    }

    public function getRandomStatus()
    {
        # Generate random status
        $statuses = array('draft', 'published');
        return $statuses[array_rand($statuses)];
    }
}
