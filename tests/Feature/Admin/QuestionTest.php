<?php

namespace Tests\Feature\Admin;

use App\Models\Question;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class QuestionTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_admin_can_create_question_successfully(): void
    {
        // Arrange 
        $userAdmin = $this->createUser(null, ['role' => 'ADMIN']);
        $category = $this->createCategory();
        $quiz = $this->createQuiz(null, [
            'category_id' => $category->id,
        ]);
        $question = Question::factory()->raw();

        // Act
        $response = $this
            ->actingAs($userAdmin)
            ->postJson("{$this->adminURI}/quizzes/{$quiz->id}/questions", $question);

        // Assert
        $response
            ->assertStatus(201)
            ->assertJsonCount(3, 'data')
            ->assertJsonFragment(['question' => $question['question']]);
    }

    public function test_non_admin_user_cannot_create_question(): void
    {
        // Arrange 
        $user = $this->createUser();
        $category = $this->createCategory();
        $quiz = $this->createQuiz(null, [
            'category_id' => $category->id,
        ]);
        $question = Question::factory()->raw();

        // Act
        $response = $this
            ->actingAs($user)
            ->postJson("{$this->adminURI}/quizzes/{$quiz->id}/questions", $question);

        // Assert
        $response
            ->assertStatus(403);
    }
}
