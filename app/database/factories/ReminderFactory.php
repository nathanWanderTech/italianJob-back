<?php

namespace Database\Factories;

use App\Models\Reminder;
use App\Models\Vehicle;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReminderFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Reminder::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $vehicleIds = Vehicle::all()->pluck('id')->toArray();

        return [
            'name' => $this->faker->name,
            'last_remind' => $this->faker->date(),
            'next_remind' => $this->faker->date(),
            'interval' => $this->faker->randomDigitNotNull * 10,
            'vehicle_id' => $this->faker->randomElement($vehicleIds),
        ];
    }
}
