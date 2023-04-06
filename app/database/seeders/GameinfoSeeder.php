<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Faker\Factory as FakerFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GameinfoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = FakerFactory::create();
        $faker->seed(991);
        $teamIds = DB::table('teams')->pluck('id')->all();
        $gameIds = DB::table('games')->pluck('id')->all();
        for ($i = 0; $i < 5; $i++) {
            DB::table('gameinfo')->insert([
                'team_id' => $teamIds[$faker->numberBetween(0, count($teamIds)-1)],
                'game_id' => $gameIds[$faker->numberBetween(0, count($gameIds)-1)],
                'goals' => $faker->numberBetween(0, 10),
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ]);
        }
    }
}
