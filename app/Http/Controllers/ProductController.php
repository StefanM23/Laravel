<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
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

    public function update(Request $request, $id)
    {
        $product = Product::find($id);
        // dd($product);
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'price' => 'required',
            'image' => 'required',
            'file' => 'mimes:jpeg,bmp,png',
        ]);
        
        if ($files = $request->file('file')) {
            $destinationPath = 'image/';
            $profileImage = date('YmdHis') . "." . $files->getClientOriginalExtension();
            $files->move($destinationPath, $profileImage);
            $files = $profileImage;
        } else {
            $files = $request['image'];
        }
           
        //update data in database with model
        Product::where('id', $id)->update([
            'image' => $files,
            'title' => strip_tags($request->title),
            'description' => strip_tags($request->description),
            'price' => strip_tags($request->price),
        ]);

        
        
        if ($request->ajax()) {
            return response()->json([], 204);
        }

        return redirect()->route('product.edit', $id);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'price' => 'required',
            'file' => ['required', 'mimes:jpeg,bmp,png'],
        ]);

        if ($files = $request->file('file')) {
            $destinationPath = 'image/';
            $profileImage = date('YmdHis') . "." . $files->getClientOriginalExtension();
            $files->move($destinationPath, $profileImage);
            $files = $profileImage;
        }

        //insert data in database with model
        Product::create([
            'image' => $files,
            'title' => strip_tags($request->title),
            'description' => strip_tags($request->description),
            'price' => strip_tags($request->price),
        ]);
        
        return redirect()->route('product.create');
    }
}
