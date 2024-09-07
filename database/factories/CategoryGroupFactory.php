<?php

namespace Firefly\FilamentBlog\Database\Factories;

use Firefly\FilamentBlog\Models\CategoryGroup;
use Illuminate\Database\Eloquent\Factories\Factory;

class CategoryGroupFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = CategoryGroup::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'name' => $name = $this->faker->word,
        ];
    }
}
