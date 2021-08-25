<?php

namespace App\Http\Controllers;

use App\Order;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $info = Order::with('orderProduct')->get();
        return view('orders', [
            'infoCheckout' => $info->toArray(),
        ]);
    }
}
