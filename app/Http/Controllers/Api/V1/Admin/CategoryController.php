<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Category\CategoryRequest;
use App\Http\Resources\Category\CategoryResource;
use App\Services\Admin\CategoryService;

/**
 * @group Admin endpoints
 */
class CategoryController extends Controller
{
    public function __construct(
        protected CategoryService $categoryService
    ) {
    }

    /**
     * POST Category
     *
     * Create a new category.
     *
     * @authenticated
     *
     * @response 201 {"message":"Created"}
     * @response 400 {"message": "Bad Request"}
     * @response 401 {"message": "Unauthenticated"}
     * @response 403 {"message": "Forbidden"}
     * @response 404 {"message": "Not Found"}
     */
    public function store(CategoryRequest $request)
    {
        $category = $this->categoryService->store($request->validated());

        return new CategoryResource($category);
    }
}
