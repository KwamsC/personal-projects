<?php

namespace Database\Factories;

use DateTime;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    public function definition(): array
    {
        return [
            'product' => fake()->randomElement(['TV Standaard', 'Ziggo Sport Totaal/Film1', 'Film1', 'Internet Giga & TV Max Next', 'Internet Giga & TV Complete Next']),
            'group' => fake()->randomElement(['TV', 'Zakelijk', 'Bundels met Next', 'Bundels zonder telefonie', 'Bundels met telefonie']),
            'price' => fake()->numberBetween(100, 10000),
            'btw' => 1.21,
            'startDate' => fake()->dateTimeBetween('-1 year', 'now')->format('d-m-Y'),
        ];
    }
}
