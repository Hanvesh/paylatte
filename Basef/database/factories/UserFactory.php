<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'phone_number'=>$this->faker->phoneNumber,
            'address'=>$this->faker->address,
            'aadhar'=>$this->faker->unique()->randomNumber(),
            'pancard'=>$this->faker->unique()->regexify("/^([A-Z]){5}([0-9]){4}([A-Z]){1}?$/"),
            'dob'=>$this->faker->dateTime,
            'email'=>$this->faker->unique()->email,
            'password'=>$this->faker->unique()->password,
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }
}
