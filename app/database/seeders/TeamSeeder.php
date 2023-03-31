<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Faker\Factory as FakerFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class TeamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = FakerFactory::create();
        $faker->seed(182);
        $userIds = DB::table('users')->pluck('id')->all();
        for ($i = 0; $i < 10; $i++) {
            $name = $faker->word;
            $wins = $faker->randomDigit();
            $id1 = $userIds[$faker->numberBetween(0, count($userIds)+1)];
            $id2 = $userIds[$faker->numberBetween(0, count($userIds)+1)];
            DB::table('users')->insert([
                'name' => $name,
                'speler1' => $id1,
                'speler2' => $id2,
                'total_wins' => $wins,
                'games_played' => $faker->numberBetween($wins, $wins+10),
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ]);
        }
    }
}
