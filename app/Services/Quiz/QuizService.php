<?php

namespace App\Services\Quiz;

use App\Models\Category;
use App\Models\Quiz;

class QuizService
{
    public function getRandomQuiz(Category $category): Quiz
    {
        $randomQuiz = $category->quizzes()->inRandomOrder()->first(['slug']);

        return $randomQuiz;
    }
}
