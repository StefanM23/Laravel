<?php

namespace App\Http\Controllers;

use App\Order;

class OrderProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function show($id)
    {
        $orderProductInfo = Order::with('product')->where('id', $id)->get();
        $orderDetails = Order::find($id);
        return view('orders_products', [
            'orderProductInfo' => $orderProductInfo,
            'orderDetail' => $orderDetails,
        ]);
    }
}
