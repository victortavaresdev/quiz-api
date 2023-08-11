<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LoginTest extends TestCase
{
    use RefreshDatabase;

    private User $user;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = $this->createUser(null, [
            'email' => 'teste@gmail.com',
            'password' => 'teste123',
        ]);
    }

    public function test_login_returns_access_token_with_correct_credentials(): void
    {
        // Arrange

        // Act
        $response = $this->post("{$this->authURI}/login", [
            'email' => 'teste@gmail.com',
            'password' => 'teste123',
        ]);

        // Assert
        $response
            ->assertStatus(200)
            ->assertJsonStructure([
                'accessToken',
            ]);
    }

    public function test_login_with_incorrect_credentials_returns_error(): void
    {
        // Arrange

        // Act
        $response = $this->post("{$this->authURI}/login", [
            'email' => 'teste@gmail.com',
            'password' => 'testeteste',
        ]);

        // Assert
        $response
            ->assertStatus(400);
    }

    public function test_authenticated_user_get_profile_data(): void
    {
        // Arrange

        // Act
        $response = $this
            ->actingAs($this->user)
            ->get("{$this->authURI}/profile");

        // Assert
        $response
            ->assertStatus(200)
            ->assertJsonCount(4);
    }
}
