<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ActivityLogFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'ip' => $this->faker->ipv4,
            'url' => $this->faker->url,
            'session_id' => 'hpSWmnnfPNjD3mCR1qpC1daWXH2IEdVljaSbldjQ',
            'product_id' => rand(1, 100),
            'agent' => $this->faker->userAgent,
            'created_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
        ];
    }
}
