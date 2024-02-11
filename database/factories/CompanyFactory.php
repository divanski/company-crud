<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CompanyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->company,
            'owner_first_name' => $this->faker->firstName,
            'owner_last_name' => $this->faker->lastName,
            'phone'=> $this->faker->phoneNumber,
            'address' => $this->faker->address,
            'city' => $this->faker->city,
            'country' => $this->faker->country
        ];
    }
}
