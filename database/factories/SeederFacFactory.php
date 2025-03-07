<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class SeederFacFactory extends Factory
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
            'brand' => $this->faker->name,
            'model' => $this->faker->name,
            'short_desc' => $this->faker->name,
            'desc' => $this->faker->name,
            'keywords' => $this->faker->name,
            'technical_specification' => $this->faker->name,
            'uses' => $this->withFaker()->randomFloat(2, 100, 5000),
            'photo' => $this->faker->imageUrl(),
            'price' => $this->faker->name,
            'discount' => $this->faker->name,
            'warranty' => $this->faker->name,
            'status' => $this->faker->name,
            'category_id' => $this->faker->name,
        ];
    }
}
