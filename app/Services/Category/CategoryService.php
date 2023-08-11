<?php

namespace App\Services\Category;

use App\Http\Resources\Category\CategoryResource;
use App\Models\Category;
use Illuminate\Support\Facades\Cache;

class CategoryService
{
    public function index()
    {
        $categories = Cache::remember('categories', now()->addDay(), function () {
            return CategoryResource::collection(Category::all());
        });

        return $categories;
    }
}
