<?php

namespace App\Services\Question;

use App\Models\Quiz;

class QuestionService
{
    public function index(Quiz $quiz)
    {
        $questions = $quiz->questions()->with('options')->get();

        return $questions;
    }
}
