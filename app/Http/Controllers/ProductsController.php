<?php

namespace App\Http\Controllers;

use App\Product;
use App\Order;
use Illuminate\Http\Request;
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
    public function index(Request $request)
    {
        $products = Product::all();

        if($request->ajax()){
            return response()->json($products->toArray());
        }

        return view('products', [
            'products' => $products,
        ]);
    }
    public function destroy(Request $request, $id)
    {
        Product::find($id)->delete();

        if ($request->ajax()) {
            return response()->json([], 204);
        }

        return redirect()->route('products.index');
    }
    public function edit(Request $request, $id)
    {
        $product = Product::find($id);

        if (is_null($product)) {
            $products = Product::all();
            return redirect()->route('products.index', ['products' => $products]);
        }

        if ($request->ajax()) {
            return response()->json($product->toArray());
        }

        return view('product', [
            'product' => $product,
        ]);
    }
    public function create(Request $request)
    {
        if ($request->ajax()) {
            return response()->json([], 204);
        }
        return view('product');
    }
    
}
