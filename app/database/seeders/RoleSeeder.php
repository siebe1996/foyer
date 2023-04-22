<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            'title' => \App\Enums\RolesEnum::PLAYER,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
        DB::table('roles')->insert([
            'title' => \App\Enums\RolesEnum::MODERATOR,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
        DB::table('roles')->insert([
            'title' => \App\Enums\RolesEnum::ADMINISTRATOR,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        $userIds = DB::table('users')->pluck('id')->all();
        $roleIdPlayer = DB::table('roles')->where('title','player')->value('id');
        DB::table('user_role')->insert([
            ['user_id' => $userIds[0], 'role_id' => $roleIdPlayer],
            ['user_id' => $userIds[1], 'role_id' => $roleIdPlayer]
        ]);
        $rodeIdModerator = DB::table('roles')->where('title','moderator')->value('id');
        DB::table('user_role')->insert([
            ['user_id' => $userIds[2], 'role_id' => $roleIdPlayer]
        ]);
        DB::table('user_role')->insert([
            ['user_id' => $userIds[2], 'role_id' => $rodeIdModerator]
        ]);
        $roleIdAdministrator = DB::table('roles')->where('title','administrator')->value('id');
        DB::table('user_role')->insert([
            ['user_id' => $userIds[3], 'role_id' => $roleIdPlayer]
        ]);
        DB::table('user_role')->insert([
            ['user_id' => $userIds[3], 'role_id' => $rodeIdModerator]
        ]);
        DB::table('user_role')->insert([
            ['user_id' => $userIds[3], 'role_id' => $roleIdAdministrator]
        ]);

        for ($i = 4; $i < count($userIds); $i++){
            DB::table('user_role')->insert([
                ['user_id' => $userIds[$i], 'role_id' => $roleIdPlayer],
            ]);
        }
    }
}
