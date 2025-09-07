<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Newmovie;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\MovieBooking>
 */
class MovieBookingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'movie_id' => Newmovie::factory(),
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'seats' => fake()->numberBetween(1, 10),
            'movie' => fake()->word(),
        ];
    }
}
