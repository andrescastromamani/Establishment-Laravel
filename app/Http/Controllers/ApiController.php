<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Establishment;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function getCategories()
    {
        $categories = Category::all();
        return response()->json($categories);
    }

    public function getCategory(Category $category)
    {
        $establishments = Establishment::where('category_id', $category->id)
            ->with('category')->get();
        return response()->json($establishments);
    }
}
