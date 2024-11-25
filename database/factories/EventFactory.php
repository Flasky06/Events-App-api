<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Location;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Event>
 */
class EventFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "title" => $this->faker->word(),
            "description" => $this->faker->paragraph(),
            "category_id" => Category::inRandomOrder()->first()->id ?? Category::factory()->create()->id,
            "startdatetime" => $this->faker->dateTimeBetween('now', '+1 week'),
            "enddatetime" => $this->faker->dateTimeBetween('+1 week', '+2 weeks'),
            "ticketsavailable" => $this->faker->numberBetween(1, 500),
            "price" => $this->faker->randomFloat(2, 0, 1000),
            "location_type" => $this->faker->randomElement(['online', 'physical']),
            "location_id" => Location::inRandomOrder()->first()->id ?? Location::factory()->create()->id,
            "link_url" => $this->faker->url(),
            "location_description" => $this->faker->sentence(),
            "img_url" => $this->faker->imageUrl(),
        ];

    }
}
