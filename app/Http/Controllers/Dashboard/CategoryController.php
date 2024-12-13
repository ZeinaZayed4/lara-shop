<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Carbon\Exceptions\Exception;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cats = Category::paginate(10);
        return view('dashboard.category.index', compact('cats'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'icon' => 'required',
            'photo' => 'required',
        ]);

        $filename = now()->timestamp . '_' . $request->file('photo')->getClientOriginalName();
        $filePath = 'uploads/' . $filename;
        $request->file('photo')->move('uploads', $filename);

        $newCategory = new Category;
        $newCategory->name = $request->name;
        $newCategory->icon = $request->icon;
        $newCategory->photo = $filePath;
        $newCategory->save();

        return back()->with('success', 'Category has been added successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        return view('dashboard.category.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $category = Category::find($id);

        return view('dashboard.category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required',
            'icon' => 'required',
        ]);

        if ($request->hasFile('photo')) {
            $filename = now()->timestamp . '_' . $request->file('photo')->getClientOriginalName();
            $filePath = 'uploads/' . $filename;
            $request->file('photo')->move('uploads', $filename);
        }

        $category = Category::find($id);
        $category->name = $request->name;
        $category->icon = $request->icon;
        if ($request->hasFile('photo')) {
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
        Category::destroy($id);

        return back();
    }
}
