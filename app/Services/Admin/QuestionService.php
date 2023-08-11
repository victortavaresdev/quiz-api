<?php

namespace App\Services\Admin;

use App\DTO\Question\QuestionDTO;
use App\Models\Question;
use App\Models\Quiz;

class QuestionService
{
    public function store(Quiz $quiz, QuestionDTO $dto): Question
    {
        $question = $quiz->questions()->create((array) $dto);

        return $question;
    }
}
