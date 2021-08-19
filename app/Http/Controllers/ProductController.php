<?php

namespace App\Http\Controllers;

use App\Products;
use DB;
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
        $product = Products::find($id);
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'price' => 'required',
            'image' => 'required',
            'file' => 'mimes:jpeg,bmp,png',
        ]);
        if ($product->title != $request['title'] || $product->description != $request['description'] || $product->price != $request['price'] || !empty($request['file'])) {
            if ($files = $request->file('file')) {
                $destinationPath = 'image/';
                $profileImage = date('YmdHis') . "." . $files->getClientOriginalExtension();
                $files->move($destinationPath, $profileImage);
                $files = $profileImage;
            } else {
                $files = $request['image'];
            }
            DB::table('products')
                ->where('id', $id)
                ->update([
                    'image' => $files,
                    'title' => $request['title'],
                    'description' => $request['description'],
                    'price' => $request['price'],
                ]);
        }

        return redirect()->route('product.edit', $id);
    }
    public function store()
    {
        $request = request()->validate([
            'title' => 'required',
            'description' => 'required',
            'price' => 'required',
            'image' => 'required',
        ]);
        return redirect()->route('product.create');
    }

}
