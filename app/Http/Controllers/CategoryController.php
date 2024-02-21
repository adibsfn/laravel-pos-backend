<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $categories = DB::table('categories')
        ->where(function($query) use ($request) {
            $query->orWhere('name', 'like', '%'.$request->search.'%');
        })
        ->paginate(5);


        return view('pages.category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $filename = time() . '.' . $request->image->extension();
        $request->image->storeAs('public/categories', $filename);

        $category = new \App\Models\Category;
        $category->name = $request->name;
        $category->description = $request->description;
        $category->image = $filename;
        $category->save();

        return redirect()->route('category.index');

    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('pages.category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        // $data = $request->all();
        // $category = Category::findOrFail($id);

        // $category->update($data);
        // return redirect()->route('category.index');

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('image')) {
            if ($category->image) {
                Storage::delete('public/categories/' . $category->image);
            }

            $filename = time() . '.' . $request->image->extension();
            $request->image->storeAs('public/categories', $filename);
            $validatedData['image'] = $filename;
        }

        $category->update($validatedData);

        return redirect()->route('category.index')->with('success', 'Product updated successfully.');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        Category::destroy($category->id);
        return redirect()->route('category.index');

    }
}
