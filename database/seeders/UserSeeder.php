<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->defaultUser();

        // $faker = Faker\Factory::create();

        // foreach (range(1,15) as $index) {
        //     User::create([
        //         "name"     => $faker->name,
        //         "email"    => $faker->unique()->email,
        //         "password" => bcrypt($faker->password),
        //     ]);
        // }

        foreach (range(1,5) as $index) {
                User::create([
                    "name"     => randomName(rand(0, 5)),
                    "email"    => randomTitle($index),
                    "password" => bcrypt(12345678),
                ]);
            }
    }
    public function defaultUser()
    {
        User::create([
            "name"     => "Admin",
            "user_role"     => 1,
            "email"    => "admin@gmail.com",
            "password" => bcrypt("12345678"),
        ]);
    }
}
