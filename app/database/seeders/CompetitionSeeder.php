<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Faker\Factory as FakerFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CompetitionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = FakerFactory::create();
        $faker->seed(158);
        $teamIds = DB::table('teams')->pluck('id')->all();
        for ($i = 0; $i < 5; $i++) {
            $name = $faker->word;
            $start_date = $faker->dateTimeBetween('-1 year', 'yesterday');
            $end_date = $faker->dateTimeBetween($start_date, 'now');
            DB::table('competitions')->insert([
                'name' => $name,
                'winner_id' => $teamIds[$faker->numberBetween(0, count($teamIds)-1)],
                'start_date' => $start_date,
                'end_date' => $end_date,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ]);
        }
        for ($i = 0; $i < 2; $i++){
            $name = $faker->word;
            DB::table('competitions')->insert([
                'name' => $name,
                'winner_id' => null,
                'start_date' => null,
                'end_date' => null,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ]);
        }
    }
}
