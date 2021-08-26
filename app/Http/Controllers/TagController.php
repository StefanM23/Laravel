<?php

namespace App\Http\Controllers;

use App\Order;
use App\Product;
use App\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function show(Request $request, $id)
    {
        $type = $request->query('type');
        switch ($type) {
            case 'product':
                $productOrOrder = Product::find($id);
                break;
            case 'order':
                $productOrOrder = Order::find($id);
                break;
        }

        return view('tag', [
            'productOrOrder' => $productOrOrder,
            'type' => $type,
        ]);
    }
    public function store(Request $request)
    {
        $type = $request->query('type');
        $id = $request->query('id');

        switch ($type) {
            case 'product':
                $productOrOrder = Product::find($id);
                break;
            case 'order':
                $productOrOrder = Order::find($id);
                break;
        }

        //add tag
        $request->validate([
            'tag' => 'required',
        ]);

        $tag = Tag::create([
            'name' => strip_tags($request->tag),
        ]);

        $productOrOrder->tags()->attach($tag);

        return redirect()->route('add_tag.show', [
            'id' => $id,
            'type' => $type,
        ]);
    }
}
