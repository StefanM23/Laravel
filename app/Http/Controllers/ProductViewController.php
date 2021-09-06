<?php

namespace App\Http\Controllers;

use App\Product;
use App\Comment;
use Illuminate\Http\Request;

class ProductViewController extends Controller
{
    public function show(Request $request, $id)
    {
        $product = Product::with('comment')->where('id' ,$id)->get();

        if($request->ajax()){
            return response()->json($product->toArray());
        }
        return view('view_product', [
            'product' => $product->toArray(),
        ]);
    }
    public function store(Request $request)
    {
        $id = $request->id;
        //add comment
        $request->validate([
            'comment' => 'required',
        ]);

        $tag = Comment::create([
            'comment' => strip_tags($request->comment),
            'product_id' =>  $id,
            'accepted' => false,
        ]);

        return redirect()->route('view-product.show', [
            'id' =>  $id,
        ]);
    }
}
