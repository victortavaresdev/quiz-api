<?php

namespace Tests\Feature\Admin;

use App\Models\Category;
use App\Models\Quiz;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class QuizTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_admin_can_create_quiz_successfully(): void
    {
        // Arrange 
        $userAdmin = $this->createUser(null, ['role' => 'ADMIN']);
        $category = $this->createCategory();
        $quiz = Quiz::factory()->raw();

        // Act
        $response = $this
            ->actingAs($userAdmin)
            ->postJson("{$this->adminURI}/categories/{$category->id}/quizzes", $quiz);

        // Assert
        $response
            ->assertStatus(201)
            ->assertJsonFragment(['title' => $quiz['title']]);
    }

    public function test_non_admin_user_cannot_create_quiz(): void
    {
        // Arrange 
        $user = $this->createUser();
        $category = $this->createCategory();
        $quiz = Quiz::factory()->raw();

        // Act
        $response = $this
            ->actingAs($user)
            ->postJson("{$this->adminURI}/categories/{$category->id}/quizzes", $quiz);

        // Assert
        $response
            ->assertStatus(403);
    }
}
