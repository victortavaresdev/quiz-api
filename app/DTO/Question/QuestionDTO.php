<?php

namespace App\DTO\Question;

use App\Http\Requests\Question\QuestionRequest;

class QuestionDTO
{
    public function __construct(
        public readonly string $question,
        public readonly string $correct_answer,
    ) {
    }

    public static function fromRequest(QuestionRequest $request): self
    {
        return new self(
            question: $request->validated('question'),
            correct_answer: $request->validated('correct_answer'),
        );
    }
}
