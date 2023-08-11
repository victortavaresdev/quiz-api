<?php

namespace Tests\Feature\Command;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ClearCacheCommandTest extends TestCase
{
    use RefreshDatabase;

    public function test_clear_cache_command_works(): void
    {
        // Arrange

        // Act

        // Assert
        $this->artisan('clear:cache')
            ->expectsOutput("Cache has been cleared successfully!")
            ->assertExitCode(0);
    }
}
