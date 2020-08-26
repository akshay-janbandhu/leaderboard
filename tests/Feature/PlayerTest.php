<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PlayerTest extends TestCase
{
    /**
     * Test player list
     *
     * @return void
     */
    public function testPlayerList(): void
    {
        $response = $this->get('api/players');

        $response->assertStatus(200)
            ->assertJson([
                'data' => true
            ]);
    }

    /**
     * Test player detail
     * 
     * @return void
     */
    public function testPlayerDetail(): void
    {
        $player = factory(\App\Player::class)->create([
            'first_name' => 'Aby',
            'last_name' => 'Abraham',
        ]);
        
        $response = $this->get(
            'api/players/' . $player->id, 
            [], 
            ['Accept' => 'application/json']
        );

        $response->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    'id',
                    'first_name',
                    'last_name',
                    'points',
                    'is_active',
                ]
            ]);
    }

    /**
     * Test validation when action is not in mentioned list
     * 
     * @return void
     */
    public function testInFieldOnPointsUpdate(): void
    {
        $player = factory(\App\Player::class)->create([
            'first_name' => 'Aby',
            'last_name' => 'Abraham',
        ]);

        $payload = [
            'action' => 'not_increment'
        ];

        $response = $this->post(
            "api/players/{$player->id}/points", 
            $payload, 
            []
        );

        $response->assertStatus(422)
            ->assertJson([
                "action" => [
                    "This action can only be an increment or decrement"
                ]
            ]);
    }

    /**
     * Test validation when action is required
     * 
     * @return void
     */
    public function testRequiredFieldOnPointsUpdate(): void
    {
        $player = factory(\App\Player::class)->create([
            'first_name' => 'Aby',
            'last_name' => 'Abraham',
        ]);

        $payload = [];

        $response = $this->post(
            "api/players/{$player->id}/points", 
            $payload, 
            []
        );
        
        $response->assertStatus(422)
            ->assertJson([
                "action" => [
                    "The points increment/ decrement input not provided"
                ]
            ]);
    }

    /**
     * Test successful points update
     * 
     * @return void
     */
    public function testSuccessOnPointsUpdate(): void
    {
        $player = factory(\App\Player::class)->create([
            'first_name' => 'Aby',
            'last_name' => 'Abraham',
        ]);

        $payload = [
            'action' => 'increment'
        ];

        $response = $this->post(
            "api/players/{$player->id}/points", 
            $payload, 
            []
        );
        
        $response->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    'id',
                    'first_name',
                    'last_name',
                    'points',
                    'is_active',
                ]
            ]);
    }
}
