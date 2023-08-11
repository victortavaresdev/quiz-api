<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class QuestionFactory extends Factory
{
    public function definition(): array
    {
        return [
            'question' => fake()->text(20),
            'correct_answer' => fake()->text(10),
        ];
    }
}
