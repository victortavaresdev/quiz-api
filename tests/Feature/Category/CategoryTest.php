<?php

namespace Tests\Feature\Category;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CategoryTest extends TestCase
{
    use RefreshDatabase;

    public function test_get_category_list_successfull(): void
    {
        // Arrange 
        $this->createCategory(3);

        // Act
        $response = $this
            ->getJson($this->categoryURI);

        // Assert
        $response
            ->assertStatus(200)
            ->assertJsonCount(3, 'data');
    }
}
