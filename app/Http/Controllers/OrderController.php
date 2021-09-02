<?php

namespace App\Http\Controllers;

use App\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $info = Order::with('orderProduct')->get();

        if($request->ajax()){
            return response()->json($info->toArray());
        }
        return view('orders', [
            'infoCheckout' => $info->toArray(),
        ]);
    }
}
