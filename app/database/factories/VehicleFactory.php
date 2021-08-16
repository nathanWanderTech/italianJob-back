<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Vehicle;
use Illuminate\Database\Eloquent\Factories\Factory;

class VehicleFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Vehicle::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $userIds = User::all()->pluck('id')->toArray();

        return [
            'name' => $this->faker->name(),
            'brand' => $this->faker->randomElement(['Toyota', 'Honda', 'Yamaha']),
            'total_traveled_distance' => $this->faker->randomDigitNotNull(),
            'daily_traveled_distance' => $this->faker->randomDigitNotNull(),
            'owner_id' => $this->faker->randomElement($userIds),
        ];
    }
}
