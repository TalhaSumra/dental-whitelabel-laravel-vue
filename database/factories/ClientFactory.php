<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ClientFactory extends Factory
{
    public function definition(): array
    {
        return [
            'clinic_name' => fake()->company() . ' Dental',
            'slug' => Str::slug(fake()->company()) . '-' . Str::lower(Str::random(5)),
            'contact_name' => fake()->name(),
            'contact_email' => fake()->safeEmail(),
            'contact_phone' => fake()->phoneNumber(),
            'website_url' => fake()->url(),
            'city' => fake()->city(),
            'province' => 'Ontario',
            'country' => 'Canada',
            'status' => 'active',
        ];
    }
}
