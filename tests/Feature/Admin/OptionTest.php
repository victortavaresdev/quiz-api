<?php

namespace Tests\Feature\Admin;

use App\Models\Option;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class OptionTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_admin_can_create_option_successfully(): void
    {
        // Arrange 
        $userAdmin = $this->createUser(null, ['role' => 'ADMIN']);
        $category = $this->createCategory();
        $quiz = $this->createQuiz(null, [
            'category_id' => $category->id,
        ]);
        $question = $this->createQuestion(null, [
            'quiz_id' => $quiz->id,
        ]);
        $options = Option::factory()->raw();

        // Act
        $response = $this
            ->actingAs($userAdmin)
            ->postJson("{$this->adminURI}/questions/{$question->id}/options", $options);

        // Assert
        $response
            ->assertStatus(201)
            ->assertJsonCount(2, 'data');
    }

    public function test_non_admin_user_cannot_create_options(): void
    {
        // Arrange 
        $user = $this->createUser();
        $category = $this->createCategory();
        $quiz = $this->createQuiz(null, [
            'category_id' => $category->id,
        ]);
        $question = $this->createQuestion(null, [
            'quiz_id' => $quiz->id,
        ]);
        $options = Option::factory()->raw();

        // Act
        $response = $this
            ->actingAs($user)
            ->postJson("{$this->adminURI}/questions/{$question->id}/options", $options);

        // Assert
        $response
            ->assertStatus(403);
    }
}
