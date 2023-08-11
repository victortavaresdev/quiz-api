<?php

namespace App\Services\Admin;

use App\Models\Category;
use App\Models\Quiz;

class QuizService
{
    public function store(Category $category, array $title): Quiz
    {
        $quiz = $category->quizzes()->create($title);

        return $quiz;
    }
}
