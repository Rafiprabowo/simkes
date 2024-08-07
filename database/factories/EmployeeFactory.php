<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Employee>
 */
class EmployeeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //
            'position' => $this->faker->jobTitle(),
            'date_of_birth' => $this->faker->date(),
            'gender' => $this->faker->randomElement(['L', 'P']),
            'emergency_contact_name' => $this->faker->name(),
            'emergency_contact_number' => $this->faker->phoneNumber(),
            'emergency_contact_relationship' => $this->faker->jobTitle(),
            'emergency_contact_address' => $this->faker->address(),
        ];
    }
}
