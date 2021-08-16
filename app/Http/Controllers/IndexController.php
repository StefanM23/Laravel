<?php

namespace App\Http\Controllers;

use App\Products;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index(Request $request)
    {
        $products = $request->session()->has('cart') ? Products::whereNotIn('id', $request->session()->get('cart'))->get() : Products::all();

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
