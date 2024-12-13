<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Photo;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::with(['category'])->paginate(10);
        return view('dashboard.product.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $cats = Category::get();
        return view('dashboard.product.create', compact('cats'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'category_id' => 'required',
        ]);

        $inputs =  $request->all();
        $inputs['SKU'] = '';
        $newProduct = Product::create($inputs);

        if ($request->hasFile('photos')) {
            foreach ($request->file('photos') as $photo) {
                $filename = now()->timestamp . '_' . $photo->getClientOriginalName();
                $filePath = 'uploads/product/' . $filename;
                $photo->move('uploads/product/', $filename);

                Photo::create([
                    'name' => $filename,
                    'path' => $filePath,
                    'product_id' => $newProduct->id,
                ]);
            }
        }

        return back()->with('success', 'Product has been added successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        $product->load(['category', 'photos']);
        return view('dashboard.product.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product = Product::find($id);
        return view('dashboard.product.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([

           'name' => 'required',
           'description' => 'required',
            'price' => 'required',
            'stock' => 'required',
            'category_id' => 'required',
        ]);

        if ($request->hasFile('photos')) {
            $filename = now()->timestamp . '_' . $request->file('photos')->getClientOriginalName();
            $filePath = 'uploads/' . $filename;
            $request->file('photos')->move('uploads', $filename);
        }

        $category = Category::find($id);
        $category->name = $request->name;
        $category->icon = $request->icon;
        if ($request->hasFile('photos')) {
            $category->photo = $filePath;
        }
        $category->save();

        return back()->with('success', 'Category has been updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Product::destroy($id);
        return back();
    }
}
