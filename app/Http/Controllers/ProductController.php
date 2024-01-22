<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    // index
    public function index(Request $request)
    {
        // $products = \App\Models\Product::paginate(5);
        // return view('pages.product.index', compact('products'));
        $products = DB::table('products')
            -> when($request->search, function ($query) use ($request) {
                return $query->where('name', 'like', "%{$request->search}%");
            })
            -> paginate(5);
        return view('pages.product.index', compact ('products'));
    }

     // create
    public function create()
    {
        $categories = \App\Models\Category::all();
        return view('pages.product.create', compact('categories'));
    }

    // store
    public function store(Request $request)
    {
        $filename = time() . '.' . $request->image->extension();
        $request->image->storeAs('public/products', $filename);
        $product = new \App\Models\Product;
        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = (int) $request->price;
        $product->stock = (int) $request->stock;
        $product->category_id = $request->category_id;
        $product->image = $filename;
        $product->save();

        return redirect()->route('product.index');
    }

    //edit
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $categories = \App\Models\Category::all();
        return view('pages.product.edit', compact('product', 'categories'));
    }

    // Update
     public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        //if image is not empty, then update the image
        if ($request->image) {
            $filename = time() . '.' . $request->image->extension();
            $request->image->storeAs('public/products', $filename);
            $product->image = $filename;
        }
        $product->update($request->all());

        return redirect()->route('product.index')->with('success', 'Product updated successfully');
    }

    // Destory
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();
        return redirect()->route('product.index');
    }
}
