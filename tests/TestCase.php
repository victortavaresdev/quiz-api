<?php

namespace Tests;

use App\Models\Category;
use App\Models\Option;
use App\Models\Question;
use App\Models\Quiz;
use App\Models\User;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    public string $adminURI = '/api/v1/admin';
    public string $authURI = '/api/v1/auth';
    public string $userURI = '/api/v1/users';
    public string $categoryURI = '/api/v1/categories';
    public string $quizzesURI = '/api/v1/quizzes';
    public string $questionsURI = '/api/v1/questions';

    public function createUser(int|null $count = null, array $items = []): User
    {
        return User::factory($count)->create($items);
    }

    public function createCategory(int|null $count = null, array $items = [])
    {
        return Category::factory($count)->create($items);
    }

    public function createQuiz(int|null $count = null, array $items = [])
    {
        return Quiz::factory($count)->create($items);
    }

    public function createQuestion(int|null $count = null, array $items = [])
    {
        return Question::factory($count)->create($items);
    }

    public function createOption(int|null $count = null, array $items = [])
    {
        return Option::factory($count)->create($items);
    }
}
