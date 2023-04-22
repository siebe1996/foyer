<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Faker\Factory as FakerFactory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'first_name' => 'Bart',
            'last_name' => 'Delrue',
            'email' => 'bartdelrue@odisee.be',
            'password' => Hash::make('Azerty123'),
            'total_wins' => 0,
            'games_played' => 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
        DB::table('users')->insert([
            'first_name' => 'Joris',
            'last_name' => 'Maervoet',
            'email' =>'jorismaervoet@odisee.be',
            'password' => Hash::make('Azerty123'),
            'total_wins' => 0,
            'games_played' => 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
        DB::table('users')->insert([
            'first_name' => 'Pieter',
            'last_name' => 'Van Peteghem',
            'email' => 'pietervanpeteghem@odisee.be',
            'password' => Hash::make('Azerty123'),
            'total_wins' => 0,
            'games_played' => 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
        DB::table('users')->insert([
            'first_name' => 'Davy',
            'last_name' => 'De Winne',
            'email' => 'davydewinne@odisee.be',
            'password' => Hash::make('Azerty123'),
            'total_wins' => 0,
            'games_played' => 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        /*$userIds = DB::table('users')->pluck('id')->all();
        DB::table('user_has_target')->insert([
            ['user_id' => $userIds[0], 'target_id' => $userIds[1]],
            ['user_id' => $userIds[1], 'target_id' => $userIds[2]],
            ['user_id' => $userIds[2], 'target_id' => $userIds[3]],
            ['user_id' => $userIds[3], 'target_id' => $userIds[0]],
            //['user_id' => $userIds[4], 'target_id' => $userIds[0]]
        ]);*/

        $faker = FakerFactory::create();
        $faker->seed(222);
        for ($i = 4; $i < 10; $i++) {
            $firstName = $faker->firstName;
            $lastName = $faker->lastName;
            $wins = $faker->randomDigit();
            $email = strtolower(str_replace(' ', '', $firstName) . str_replace(' ', '', $lastName)) . '@odisee.be';
            DB::table('users')->insert([
                'first_name' => $firstName,
                'last_name' => $lastName,
                'email' => $email,
                'password' => Hash::make('Azerty123'),
                'total_wins' => $wins,
                'games_played' => $faker->numberBetween($wins, $wins+10),
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ]);
        }

        //$firstUser = DB::table('users')->where('id', 1);
        //$firstUser->update(['target_id' => 10]);

        /*$userIds = DB::table('users')->pluck('id')->all();
        for ($i = 1; $i <= count($userIds); $i++){
            if ($i == count($userIds)){
                $targetId = $userIds[0];
                }
            else{
                $targetId = $userIds[$i];
            }
            DB::table('game_user')->insert([
                'game_id' => 1 ,
                'user_id' => $userIds[$i-1],
                'kills' => 0,
                'alive' => true,
                'target_id' => $targetId
            ]);
        }*/

        DB::table('users')->insert([
            'first_name' => 'Dries',
            'last_name' => 'Loco',
            'email' => 'driesloco@odisee.be',
            'password' => Hash::make('Azerty123'),
            'total_wins' => 2,
            'games_played' => 5,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        //$lastUserId = DB::table('users')->pluck('id')->last();
        /*DB::table('game_user')->insert([
            'game_id' => 2 ,
            'user_id' => 11,
            'kills' => 0,
            'alive' => true,
            'target_id' => null
        ]);
        DB::table('game_user')->insert([
            'game_id' => 3 ,
            'user_id' => 1,
            'kills' => 0,
            'alive' => true,
            'target_id' => null
        ]);*/
        /*$userIds = DB::table('users')->pluck('id')->all();
        for ($i = 0; $i < count($userIds); $i++){
            if ($i < (count($userIds) - 1)){
                DB::table('user_has_target')->insert([
                    ['user_id' => $userIds[$i], 'target_id' => $userIds[$i+1]],
                ]);
            }
            else {
                DB::table('user_has_target')->insert([
                    ['user_id' => $userIds[$i], 'target_id' => $userIds[0]],
                ]);
            }
        }*/
    }
}
