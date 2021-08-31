<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index(Request $request)
    {
        $products = $request->session()->has('cart') ? Product::whereNotIn('id', $request->session()->get('cart'))->get() : Product::all();
        if($request->ajax()){
            return response()->json($products->toArray());
        }
        // $request->session()->flash('cart', 'Task was successful!');
        return view('index');
    }
    
    public function store(Request $request)
    {
        if (isset($request->id)) {
            $idProduct = $request->id;
            $request->session()->put('cart.' . $idProduct, $idProduct);
        }

        if($request->ajax()){
            return response()->json([], 204);
        }

        return redirect()->route('index');
    }
}
