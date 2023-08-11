<?php

namespace Tests\Feature\Admin;

use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CategoryTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_admin_can_create_category_successfully(): void
    {
        // Arrange 
        $userAdmin = $this->createUser(null, ['role' => 'ADMIN']);
        $category = Category::factory()->raw();

        // Act
        $response = $this
            ->actingAs($userAdmin)
            ->postJson("{$this->adminURI}/categories", $category);

        // Assert
        $response
            ->assertStatus(201)
            ->assertJsonFragment(['name' => $category['name']]);
    }

    public function test_non_admin_user_cannot_create_category(): void
    {
        // Arrange 
        $user = $this->createUser();
        $category = Category::factory()->raw();

        // Act
        $response = $this
            ->actingAs($user)
            ->postJson("{$this->adminURI}/categories", $category);

        // Assert
        $response
            ->assertStatus(403);
    }
}
