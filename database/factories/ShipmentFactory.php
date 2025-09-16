<?php

namespace Database\Factories;

use App\Models\Fleet;
use App\Models\Shipment;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Shipment>
 */
class ShipmentFactory extends Factory
{
     protected $model = Shipment::class;

    public function definition()
    {
        return [
            'tracking_number' => 'TRK' . $this->faker->unique()->numberBetween(100000, 999999),
            'shipment_date' => $this->faker->date(),
            'origin' => $this->faker->city,
            'destination' => $this->faker->city,
            'status' => $this->faker->randomElement(['pending', 'in_transit', 'delivered']),
            'item_details' => $this->faker->sentence,
            'fleet_id' => Fleet::factory(),
        ];
    }
}
