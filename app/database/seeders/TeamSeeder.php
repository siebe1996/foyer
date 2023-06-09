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
            $id1 = $userIds[$faker->numberBetween(0, count($userIds)-1)];
            $id2 = $userIds[$faker->numberBetween(0, count($userIds)-1)];
            /*if($id1 == $id2){
                $id2 = $this->reroll($id1, $userIds, $faker);
            }*/
            DB::table('teams')->insert([
                'name' => $name,
                'player1_id' => $id1,
                'player2_id' => $id2,
                'total_wins' => $wins,
                'games_played' => $faker->numberBetween($wins, $wins+10),
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ]);
        }

        //
        //Teams needed for start anon game, DONT DELETE
        //------------------------------------------------------------
        $anon1 = DB::table('users')->where('email', 'anon1@example.com')->pluck('id')->first();
        DB::table('teams')->insert([
            'name' => 'Team1',
            'player1_id' => $anon1,
            'total_wins' => 0,
            'games_played' => 0,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
        $anon2 = DB::table('users')->where('email', 'anon2@example.com')->pluck('id')->first();
        DB::table('teams')->insert([
            'name' => 'Team2',
            'player1_id' => $anon2,
            'total_wins' => 0,
            'games_played' => 0,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
        //------------------------------------------------------------
    }
    /*public function reroll($id1, $userIds, $faker){
        $id2 = $userIds[$faker->numberBetween(0, count($userIds)+1)];
        if ($id1 == $id2){
            $id2 = $this->reroll($id1, $userIds, $faker);
        }
        return $id2;
    }*/
}
