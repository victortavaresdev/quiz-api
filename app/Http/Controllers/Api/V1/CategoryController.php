<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Services\Category\CategoryService;
use Illuminate\Support\Facades\Cache;

/**
 * @group Category endpoints
 */
class CategoryController extends Controller
{
    public function __construct(
        protected CategoryService $categoryService
    ) {
    }

    /**
     * GET Categories
     *
     * Get categories list.
     *
     * @response 200 {"message":"OK"}
     */
    public function index()
    {
        $this->categoryService->index();

        return Cache::get('categories');
    }
}
