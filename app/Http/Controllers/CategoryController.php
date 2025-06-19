<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Опционально: вернуть список категорий, если понадобится
    }

    /**
     * Show the form for creating a new resource (not needed now).
     */
    public function create()
    {
        // Если хочешь оставить пустым — ок
    }

    /**
     * Store a newly created category in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('categories')->where(fn ($query) => $query->where('user_id', auth()->id())),
            ],
        ], [
            'name.unique' => 'Exist this category.',
        ]);
        

        Category::create([
            'name' => $validated['name'],
            'user_id' => auth()->id(),
        ]);

        return redirect()->route('product.create')->with('success', 'Category added successfully!');
    }

    public function show(Category $category)
    {
        //
    }

    public function edit(Category $category)
    {
        //
    }

    public function update(Request $request, Category $category)
    {
        //
    }

    public function destroy(Category $category)
    {
        //
    }
}
