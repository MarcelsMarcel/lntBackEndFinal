<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Http\Requests\StoreProductRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::all();

        return View::make('admin.home')
            ->with('products', $products);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return View::make('products.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {
        $request->validated();

        $path = $request->file('image')->store('uploads', 'public');

        Product::create([
            'name' => $request->name,
            'author' => $request->author,
            'publisher' => $request->publisher,
            'page' => $request->page,
            'price' => $request->price,
            'image' => $path
        ]);

        return redirect()->route('admin.home');
    }


    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        $user = Auth::user();

        if ($user->role === 'admin') {
            return view('products.show-admin', compact('product'));
        } else {
            return view('products.show', compact('product'));
        }
    }



    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        return View::make('products.edit')->with('product', $product);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required',
            'author' => 'required',
            'publisher' => 'required',
            'page' => 'required',
            'price' => 'required',
            'image' => 'nullable|image|mimes:png,jpg'
        ]);

        $product->name = $request->name;
        $product->author = $request->author;
        $product->publisher = $request->publisher;
        $product->page = $request->page;
        $product->price = $request->price;

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('uploads', 'public');
            $product->image = $path;
        }

        $product->save();
        return redirect()->route('home');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        Product::destroy($product->id);

        return redirect('product');
    }
}
