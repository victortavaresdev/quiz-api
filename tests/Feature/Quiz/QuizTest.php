<?php

namespace Tests\Feature\Quiz;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class QuizTest extends TestCase
{
    use RefreshDatabase;

    public function test_get_random_quiz_by_category_slug_successfull(): void
    {
        // Arrange 
        $category = $this->createCategory();
        $this->createQuiz(3, [
            'category_id' => $category->id,
        ]);

        // Act
        $response = $this
            ->getJson("{$this->categoryURI}/{$category->slug}/random-quiz");

        // Assert
        $response
            ->assertStatus(200)
            ->assertJsonCount(1, 'data');
    }
}
