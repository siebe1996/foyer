<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ApiTest extends TestCase
{

    public function test_games_index(){
        $user = User::make([
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'password' => bcrypt('secret'),
        ]);

        $response = $this->actingAs($user)->get('/api/games');
        $response->assertStatus(200);
    }

    public function test_games_show(){
        $user = User::make([
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'password' => bcrypt('secret'),
        ]);
        $response = $this->actingAs($user)->get('api/games/a');
        $response->assertStatus(400);
    }

    public function test_target(){
        $user = User::make([
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'password' => bcrypt('secret'),
        ]);
        $response = $this->actingAs($user)->get('api/target');
        $response->assertStatus(400);
    }
}
