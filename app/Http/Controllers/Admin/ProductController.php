<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use Log;
use App\Http\Requests\ProductStoreRequest;
use App\Http\Requests\ProductUpdateRequest;
class ProductController extends Controller
{

    public function create()
    {
        $categories = Category::all();
        return view('admin.products.create', compact('categories'));
    }


    public function store(ProductStoreRequest $request)
    {

        try {
            $product = Product::create([
                'name' => $request->name,
                'description' => $request->description,
                'price' => $request->price,
                'category_id' => $request->category_id,
                'star_rating' => $request->star_rating,
                'image' => $request->image,
                // 'image_path' => $imagePath,
            ]);

            if ($request->hasFile('image')) {
                foreach ($request->file('image') as $image) {
                    $product->addMedia($image)->toMediaCollection('image');
                }
            }
            return redirect()->route('admin.dashboard')->with('success', 'Product added successfully!');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    public function index()
    {
        $products = Product::with('category')->get(); // Retrieve all products from the database
        return view('admin.dashboard', compact('products'));
    }

    public function edit(Product $product)
    {
        $categories = Category::all();
        return view('admin.products.edit', compact('product', 'categories'));
    }

    public function update(ProductUpdateRequest $request, Product $product)
    {
        try {
            $product->update([
                'name' => $request->name,
                'description' => $request->description,
                'price' => $request->price,
                'category_id' => $request->category_id,
                'image' => $request->image,
                'star_rating' => $request->star_rating,
            ]);
           
            if ($request->hasFile('image')) {
                $product->clearMediaCollection('image');
                foreach ($request->file('image') as $image) {
                    $product->addMedia($image)->toMediaCollection('image');
                }
            }

            return redirect()->route('admin.dashboard')->with('success', 'Product updated successfully!');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    public function destroy(Product $product)
    {
        $product->clearMediaCollection('images'); // Clear the media associated with the product
        $product->delete(); // Delete the product
        return redirect()->route('admin.dashboard')->with('success', 'Product deleted successfully!');
    }

    public function show(Product $product)
    {
        return view('admin.products.show', compact('product'));
    }
}
