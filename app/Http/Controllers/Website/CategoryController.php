<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function show($id)
    {
        $category = Category::find($id);

        $products = Product::with('photos')->where('category_id', $id)->paginate(9);

        $start = ($products->currentPage() - 1) * $products->perPage();

        return view('website.category', compact('category', 'products', 'start'));
    }
}
