<?php

namespace Tests\Feature\Question;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class QuestionTest extends TestCase
{
    use RefreshDatabase;

    public function test_get_questions_list_by_quiz_slug_successfull(): void
    {
        // Arrange 
        $category = $this->createCategory();
        $quiz = $this->createQuiz(null, [
            'category_id' => $category->id,
        ]);
        $this->createQuestion(5, [
            'quiz_id' => $quiz->id,
        ]);

        // Act
        $response = $this
            ->getJson("{$this->quizzesURI}/{$quiz->slug}/questions");

        // Assert
        $response
            ->assertStatus(200)
            ->assertJsonCount(5, 'data');
    }
}
