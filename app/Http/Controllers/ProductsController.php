<?php

namespace App\Http\Controllers;

use App\Product;

class ProductsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $products = Product::all();
        return view('products', [
            'products' => $products,
        ]);
    }
    public function destroy($id)
    {
        Product::find($id)->delete();
        return redirect()->route('products.index');
    }
    public function edit($id)
    {
        $product = Product::find($id);

        if (is_null($product)) {
            $products = Product::all();
            return redirect()->route('products.index', ['products' => $products]);
        }

        return view('product', [
            'product' => $product,
        ]);
    }
    public function create()
    {
        return view('product');
    }
}
