<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index(Request $request)
    {
        $products = $request->session()->has('cart') ? Product::whereNotIn('id', $request->session()->get('cart'))->get() : Product::all();
        return response()->json($products->toArray());
        return view('index', [
            'products' => $products,
        ]);
    }

    public function store(Request $request)
    {
        if (isset($request->id)) {
            $idProduct = $request->id;
            $request->session()->put('cart.' . $idProduct, $idProduct);
        }
        return redirect('/index');
    }
}
