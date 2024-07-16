<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->createMany([
            [
                'name' => 'Parent 1',
                'email' => 'parent1@parent.eu',
            ],
            [
                'name' => 'Parent 2',
                'email' => 'parent2@parent.eu',
            ],
            [
                'name' => 'Parent 3',
                'email' => 'parent3@parent.eu',
            ],
            [
                'name' => 'Parent 4',
                'email' => 'parent4@parent.eu',
            ],
            [
                'name' => 'Parent 5',
                'email' => 'parent5@parent.eu',
            ],
            [
                'name' => 'Parent 6',
                'email' => 'parent6@parent.eu',
            ],
        ]);
    }
}
