<?php

namespace Tests\Feature\Result;

use App\Models\Result;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ResultTest extends TestCase
{
    use RefreshDatabase;

    public function test_create_result_with_valid_data_successfull(): void
    {
        // Arrange 
        $user = $this->createUser();
        $resultsData = Result::factory()->raw();

        // Act
        $response = $this
            ->actingAs($user)
            ->postJson('/api/v1/results',  $resultsData);

        // Assert
        $response
            ->assertStatus(201)
            ->assertJsonCount(2, 'data');
    }

    public function test_get_results_by_user_id_successfull(): void
    {
        // Arrange 
        $user = $this->createUser();
        Result::factory()->create([
            'user_id' => $user->id,
        ]);

        // Act
        $response = $this
            ->getJson("/api/v1/results/{$user->id}");

        // Assert
        $response
            ->assertStatus(200);
    }
}
