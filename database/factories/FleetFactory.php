<?php

namespace Database\Factories;

use App\Models\Fleet;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Fleet>
 */
class FleetFactory extends Factory
{
    protected $model = Fleet::class;

    public function definition()
    {
        return [
            'fleet_number' => 'FLEET-' . $this->faker->unique()->numberBetween(1000, 9999),
            'vehicle_type' => $this->faker->randomElement(['Truk', 'Van', 'Pickup']),
            'availability' => 'available',
            'capacity' => $this->faker->numberBetween(500, 5000),
        ];
    }
}
