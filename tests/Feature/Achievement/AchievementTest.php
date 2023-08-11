<?php

namespace Tests\Feature\Achievement;

use App\Models\Achievement;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AchievementTest extends TestCase
{
    use RefreshDatabase;

    public function test_create_achievement_with_valid_data_successfull(): void
    {
        // Arrange 
        $user = $this->createUser();
        $achievementData = Achievement::factory()->raw();

        // Act
        $response = $this
            ->actingAs($user)
            ->postJson('/api/v1/achievements',  $achievementData);

        // Assert
        $response
            ->assertStatus(201)
            ->assertJsonCount(3, 'data');
    }

    public function test_get_achievements_list_by_user_id_successfull(): void
    {
        // Arrange 
        $user = $this->createUser();
        Achievement::factory(2)->create([
            'user_id' => $user->id
        ]);

        // Act
        $response = $this
            ->getJson("/api/v1/achievements/{$user->id}");

        // Assert
        $response
            ->assertStatus(200)
            ->assertJsonCount(2, 'data');
    }
}
