<?php

namespace App\Http\Controllers;

use App\Products;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index(Request $request)
    {
       
        if ($request->session()->has('cart')) {
            $addCartProductId = $request->session()->get('cart');
        }
        $products = $request->session()->has('cart') ? Products::whereIn('id', $addCartProductId)->get() : Products::all();
        return view('cart', [
            'products' => $products,
        ]);
    }
    public function destroy(Request $request)
    {
        if (isset($request->id)) {
            $idCartProject = $request->id;
            $request->session()->pull('cart.' . $idCartProject);
        }
    }
    public function store(Request $request)
    {
        dump($request);
    }
}
