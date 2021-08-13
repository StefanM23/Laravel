<?php

namespace App\Http\Controllers;

use App\Products;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function index(Request $request)
    {
        if (isset($request->id)) {
            $idProduct = $request->id;
            $request->session()->put('cart.' . $idProduct, $idProduct);
        }

        $products = $request->session()->has('cart') ? Products::whereNotIn('id', $request->session()->get('cart'))->get() : Products::all();
       

        return view('index', [
            'products' => $products,
        ]);
    }
    

}
