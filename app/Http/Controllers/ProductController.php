<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // $products = DB::table('products')
        // ->where(function($query) use ($request) {
        //     $query->orWhere('name', 'like', '%'.$request->search.'%');
        // })
        // ->paginate(5);

        $productactive = Product::where('is_available', 1)->paginate(5);
        $productinactive = Product::where('is_available', 0)->paginate(5);

        return view('pages.product.index', compact('productactive', 'productinactive'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();

        return view('pages.product.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $filename = time() . '.' . $request->image->extension();
        $request->image->storeAs('public/products', $filename);

        $product = new \App\Models\Product;
        $product->name = $request->name;
        $product->price = (int) $request->price;
        $product->stock = (int) $request->stock;
        $product->category_id = $request->category_id;
        $product->image = $filename;
        $product->save();

        return redirect()->route('product.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::all();
        return view('pages.product.edit', compact('product', 'categories'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|numeric|min:0',
            'category_id' => 'required|exists:categories,id',
            'is_available' => 'required',
        ]);

        if ($request->hasFile('image')) {
            if ($product->image) {
                Storage::delete('public/products/' . $product->image);
            }

            $filename = time() . '.' . $request->image->extension();
            $request->image->storeAs('public/products', $filename);
            $validatedData['image'] = $filename;
        }

        $product->update($validatedData);

        return redirect()->route('product.index')->with('success', 'Product updated successfully.');
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        Product::destroy($product->id);
        Storage::delete('public/products/' . $product->image);
        return redirect()->route('product.index');
    }
}
