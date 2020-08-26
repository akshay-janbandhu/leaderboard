<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class PlayerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Player::create([
            'first_name' => 'John',
            'last_name' => 'Doe',
            'created_at' => Carbon::now()->timestamp,
            'updated_at' => Carbon::now()->timestamp,
        ]);

        \App\Player::create([
            'first_name' => 'Lincoln',
            'last_name' => 'Mann',
            'created_at' => Carbon::now()->timestamp,
            'updated_at' => Carbon::now()->timestamp,
        ]);

        \App\Player::create([
            'first_name' => 'Rory',
            'last_name' => 'Hodge',
            'created_at' => Carbon::now()->timestamp,
            'updated_at' => Carbon::now()->timestamp,
        ]);

        \App\Player::create([
            'first_name' => 'Gregory',
            'last_name' => 'Foley',
            'created_at' => Carbon::now()->timestamp,
            'updated_at' => Carbon::now()->timestamp,
        ]);

        \App\Player::create([
            'first_name' => 'Dominic',
            'last_name' => 'Dunn',
            'created_at' => Carbon::now()->timestamp,
            'updated_at' => Carbon::now()->timestamp,
        ]);
    }
}
