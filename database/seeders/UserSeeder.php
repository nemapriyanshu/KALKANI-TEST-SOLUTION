<?php

namespace Database\Seeders;

use App\Models\User;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        for ($i = 0; $i < 50; $i++) {

            User::create([
                "firstname" => $faker->firstName,
                "lastname" => $faker->lastName,
                "mobilenumber" => $faker->phoneNumber,
                "email" => $faker->email,
                "address1" => $faker->address,
                "city" => $faker->city,
                "state" => $faker->state,
                "type" => "Office",
                "pincode" => $faker->numberBetween(0001, 999999),
                "password" => $faker->password,
                "age" => $faker->numberBetween(1,100),
            ]);
        }
    }
}
