<?php

namespace App\Http\Controllers\Admin;

use App\Models\Doctor;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    public function index()
    {
        $doctors = Doctor::all();
        return view('admin.dashboard', compact('doctors'));
    }

    public function showAddProductForm()
    {
        return view('admin.products.add');
    }

    public function storeProduct(Request $request){
        $product = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'category' => 'required|string',
            'price' => 'required|numeric',
            'productImage' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        if ($request->hasFile('productImage')) {
            $imagePath = $request->file('productImage')->store('uploads', 'public');
            $validatedData['image'] = $imagePath;
        }
    
        // Remove the 'productImage' from the validated data array
        unset($validatedData['productImage']);

        // dd($product);
        Product::create($product);
        return redirect()->route('admin.dashboard')->with('message', 'Product added successfully');
    }

    public function showAllProducts()
    {
        $products = Product::with('images')->get();
        return view('admin.products.index', compact('products'));
    }

    public function editProductPage(Product $product)
    {
        return view('admin.products.edit', compact('product'));
    }

    public function updateProduct(Request $request, Product $product)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'category' => 'required|string',
            'price' => 'required|numeric',
            'productImage' => 'sometimes|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        if ($request->hasFile('productImage')) {
            $imagePath = $request->file('productImage')->store('uploads', 'public');
            $validatedData['image'] = $imagePath;
        }

        $product->update($validatedData);

        return redirect()->route('admin.products.index')->with('message', 'Product updated successfully');
    }

    public function deleteProduct(Product $product)
    {
        $product->delete();
        return redirect()->back()->with('message', 'Product deleted successfully');
    }
}
