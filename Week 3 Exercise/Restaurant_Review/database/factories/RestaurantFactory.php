<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Restaurant>
 */
class RestaurantFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            //
            "restaurant_name" => $this -> faker -> name,
            "restaurant_image" => $this -> faker -> name,
            "description_text" => $this -> faker -> sentence,
            "location" => $this -> faker -> name,
            "rating" => $this -> faker -> numberBetween(0,5),
            "opening_hours" => $this -> faker -> name,
        ];
    }

}
