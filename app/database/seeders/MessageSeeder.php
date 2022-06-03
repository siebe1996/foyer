<?php

namespace Database\Seeders;

use Faker\Factory as FakerFactory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MessageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = FakerFactory::create();
        $faker->seed(999);
        $users = DB::table('users')->get();
        foreach ($users as $user) {
            $amount = $faker->numberBetween(0, 6);
            for ($i = 0; $i < $amount; $i++) {
                DB::table('messages')->insert([
                    'content' => $faker->realText(100, 3),
                    'sender_id' => $user->id,
                    'receiver_id' => rand(1,count($users)),
                    'created_at' => $faker->dateTimeBetween($user->created_at , 'now')->format('Y-m-d H:i:s'),
                    'updated_at' => null
                ]);

            }
        }
    }
}
