<?php

namespace App\Http\Controllers;

use App\Order;
use Illuminate\Http\Request;

class OrderProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function show(Request $request, $id)
    {
        //products info
        $orderProductInfo = Order::with('product')->where('id', $id)->get();
        //checkout details
        $orderDetails = Order::find($id);

        if($request->ajax()){
            return response()->json($orderProductInfo);
        }

        if (is_null($orderDetails)) {
            $info = Order::with('orderProduct')->get();
            return redirect()->route('orders.index', ['infoCheckout' => $info]);
        }

        return view('orders_products', [
            'orderProductInfo' => $orderProductInfo,
            'orderDetail' => $orderDetails,
        ]);
    }
}
