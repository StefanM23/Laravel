<?php

namespace App\Http\Controllers;

use App\Products;
use Illuminate\Http\Request;
use DB;

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
        $products = Products::all();
        return view('products', [
            'products' => $products,
        ]);
    }
    public function destroy($id)
    {
        DB::table('products')->where('id', $id)->delete();
        return redirect()->route('products');
    }
    public function edit($id){
        return view('product',['id'=>'$id']);
    }
}
