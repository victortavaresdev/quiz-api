<?php

namespace App\Services\Admin;

use App\Models\Category;

class CategoryService
{
    public function store(array $name): Category
    {
        $category = Category::create($name);

        return $category;
    }
}
