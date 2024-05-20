<?php

namespace Database\Factories\Infrastructure\Persistence\Eloquent\Models;

use App\Infrastructure\Persistence\Eloquent\Models\EloquentBook;
use Illuminate\Database\Eloquent\Factories\Factory;

class EloquentBookFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = EloquentBook::class;

    public function definition()
    {
        return [
            'name' => $this->faker->sentence,
            'isbn' => $this->faker->numerify('##########'),
            'value' => $this->faker->randomFloat(2, 1, 100)
        ];
    }
}
