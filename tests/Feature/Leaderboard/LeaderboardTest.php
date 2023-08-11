<?php

namespace Tests\Feature\Leaderboard;

use App\Models\Result;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LeaderboardTest extends TestCase
{
    use RefreshDatabase;

    public function test_get_leaderboard_users_with_results_successfully(): void
    {
        // Arrange 
        $user1 = $this->createUser();
        $user2 = $this->createUser();

        Result::factory()->create(['user_id' => $user1->id]);
        Result::factory()->create(['user_id' => $user1->id]);

        Result::factory()->create(['user_id' => $user2->id]);

        // Act
        $response = $this
            ->getJson('api/v1/leaderboard');

        // Assert
        $response
            ->assertStatus(200)
            ->assertJsonCount(2, 'data');
    }
}
