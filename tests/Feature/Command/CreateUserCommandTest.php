<?php

namespace Tests\Feature\Command;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CreateUserCommandTest extends TestCase
{
    use RefreshDatabase;

    public function test_create_user_with_artisan_command_successfully(): void
    {
        // Arrange

        // Act

        // Assert
        $this->artisan('users:create')
            ->expectsQuestion('Name of the new user', 'John')
            ->expectsQuestion('Email of the new user', 'john@gmail.com')
            ->expectsQuestion('Password of the new user', 'test123')
            ->expectsChoice('Role of the new user', 'ADMIN', ['USER', 'ADMIN'])

            ->expectsOutput("User 'john@gmail.com' created successfully")

            ->assertExitCode(0);

        $this->assertDatabaseHas('users', [
            'name' => 'John',
            'email' => 'john@gmail.com'
        ]);
    }

    public function test_create_user_with_invalid_data_returns_error(): void
    {
        // Arrange

        // Act

        // Assert
        $this->artisan('users:create')
            ->expectsQuestion('Name of the new user', '')
            ->expectsQuestion('Email of the new user', 'johngmail.com')
            ->expectsQuestion('Password of the new user', 'test')
            ->expectsChoice('Role of the new user', 'ADMIN', ['USER', 'ADMIN'])

            ->expectsOutput("The name field is required.")
            ->expectsOutput("The email field must be a valid email address.")
            ->expectsOutput("The password field must be at least 6 characters.")

            ->assertExitCode(-1);

        $this->assertDatabaseEmpty('users');
    }
}
