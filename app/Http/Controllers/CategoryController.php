<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Symfony\Component\DomCrawler\Crawler;

class CategoryController extends Controller
{

    public function index(Request $request)
    {
        $categories = Category::filterParentCategories()->get();

        return view('site.categories.index', compact('categories'));
    }

    public function show(Request $request, Category $category)
    {
        $categories = $category->getChildren();
        return view('site.categories.show', compact('category', 'categories'));
    }

}
