<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Faker\Factory as FakerFactory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GameSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = FakerFactory::create();
        $faker->seed(137);
        $competitieIds = DB::table('competities')->pluck('id')->all();
        $teamIds = DB::table('teams')->pluck('id')->all();
        for ($i = 0; $i < 7; $i++) {
            $name = $faker->word;
            $start_date = $faker->dateTimeBetween('-1 week', 'now');
            $end_date = $faker->dateTimeBetween($start_date, '+1 week');
            DB::table('games')->insert([
                'name' => $name,
                'active' => $faker->boolean(70),
                'start_date' => $start_date,
                'end_date' => $end_date,
                'competitie_id' => $competitieIds[$faker->numberBetween(0, count($competitieIds)-1)],
                'winaar' => $teamIds[$faker->numberBetween(0, count($teamIds)-1)],
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ]);
        }
        /*DB::table('games')->insert([
            'title' => 'ict',
            'active' => true,
            'start_date' => new Carbon('2016-01-23 11:53:20'),
            'end_date' => new Carbon('2023-01-23 11:53:20'),
            'weapon_id' => 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
        DB::table('games')->insert([
            'title' => 'elo',
            'active' => false,
            'start_date' => new Carbon('2023-01-23 11:53:20'),
            'end_date' => new Carbon('2024-01-23 11:53:20'),
            'weapon_id' => 2,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
        DB::table('games')->insert([
            'title' => 'chemie',
            'active' => false,
            'start_date' => new Carbon('2016-01-23 11:53:20'),
            'end_date' => new Carbon('2023-01-23 11:53:20'),
            'weapon_id' => 2,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
        DB::table('games')->insert([
            'title' => 'LTT',
            'active' => false,
            'start_date' => new Carbon('2016-01-23 11:53:20'),
            'end_date' => new Carbon('2020-01-23 11:53:20'),
            'weapon_id' => 2,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
        DB::table('games')->insert([
            'title' => 'youtube',
            'active' => false,
            'start_date' => Carbon::now(),
            'weapon_id' => 2,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
        */
        /*
        $faker = FakerFactory::create();
        $faker->seed(222);
        for ($i = 0; $i < 6; $i++) {
            DB::table('users')->insert([
                'active' => false,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ]);
        }*/
    }
}
