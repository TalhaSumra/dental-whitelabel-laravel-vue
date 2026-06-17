<?php

namespace Database\Factories;

use App\Models\Client;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProjectFactory extends Factory
{
    public function definition(): array
    {
        return [
            'client_id' => Client::factory(),
            'name' => 'Website + SEO Launch',
            'type' => 'bundle',
            'status' => 'in_progress',
            'client_price_cad' => 2500,
            'white_label_cost_cad' => 900,
            'scope' => 'Test project scope.',
        ];
    }
}
