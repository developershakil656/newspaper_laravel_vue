<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $faker = Faker\Factory::create();

        // foreach (range(1, 5) as $index) {
        //     $category = $faker->unique()->name;
        //     Category::create([
        //         "name"   => $category,
        //         "slug"   => $this->slugify($category),
        //         "status" => rand(0, 1),
        //     ]);
        // }

        foreach (range(1, 6) as $index) {
                $category = randomName($index);
                Category::create([
                    "name"   => $category,
                    "slug"   => slugify($category),
                    "status" => rand(0, 1),
                ]);
            }
    }
}
