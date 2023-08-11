<?php

namespace Database\Seeders;

use App\Models\Achievement;
use App\Models\Category;
use App\Models\Option;
use App\Models\Question;
use App\Models\Quiz;
use App\Models\Result;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $user1 = User::factory()->create();
        Result::factory(3)->create([
            'user_id' => $user1->id,
        ]);
        Achievement::factory()->create([
            'user_id' => $user1->id,
        ]);

        $user2 = User::factory()->create();
        Result::factory(1)->create([
            'user_id' => $user2->id,
        ]);
        Achievement::factory()->create([
            'user_id' => $user2->id,
        ]);

        $categoryPHP = Category::factory()->create(['name' => 'PHP']);

        $quizPHP = Quiz::factory()->create([
            'title' => 'Conceitos fundamentais do PHP',
            'category_id' => $categoryPHP->id,
        ]);

        $question1 = Question::factory()->create([
            'question' => 'O que é PHP?',
            'correct_answer' => 'PHP é uma linguagem de programação',
            'quiz_id' => $quizPHP->id,
        ]);
        Option::factory()->create([
            'option_text' => 'PHP é uma linguagem de programação',
            'question_id' => $question1->id,
        ]);
        Option::factory(3)->create([
            'question_id' => $question1->id,
        ]);

        $question2 = Question::factory()->create([
            'question' => 'Que ano foi criado o PHP?',
            'correct_answer' => '1994',
            'quiz_id' => $quizPHP->id,
        ]);
        Option::factory()->create([
            'option_text' => '1994',
            'question_id' => $question2->id,
        ]);
        Option::factory(3)->create([
            'question_id' => $question2->id,
        ]);

        $question3 = Question::factory()->create([
            'question' => 'Qual é o framework mais popular do PHP?',
            'correct_answer' => 'Laravel',
            'quiz_id' => $quizPHP->id,
        ]);
        Option::factory()->create([
            'option_text' => 'Laravel',
            'question_id' => $question3->id,
        ]);
        Option::factory(3)->create([
            'question_id' => $question3->id,
        ]);

        $question4 = Question::factory()->create([
            'question' => 'O que é o Composer?',
            'correct_answer' => 'Um gerenciador de dependências',
            'quiz_id' => $quizPHP->id,
        ]);
        Option::factory()->create([
            'option_text' => 'Um gerenciador de dependências',
            'question_id' => $question4->id,
        ]);
        Option::factory(3)->create([
            'question_id' => $question4->id,
        ]);

        $question5 = Question::factory()->create([
            'question' => 'Quem criou o PHP?',
            'correct_answer' => 'Rasmus Lerdorf',
            'quiz_id' => $quizPHP->id,
        ]);
        Option::factory()->create([
            'option_text' => 'Rasmus Lerdorf',
            'question_id' => $question5->id,
        ]);
        Option::factory(3)->create([
            'question_id' => $question5->id,
        ]);
    }
}
