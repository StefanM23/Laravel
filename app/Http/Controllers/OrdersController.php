<?php

namespace App\Http\Controllers;

use App\Orders;
use App\Items;

class OrdersController extends Controller
{
    public function index()
    {
        $infoCheckout = Items::join('orders', 'items.orders_id', '=', 'orders.id')
            ->join('products', 'items.products_id', '=', 'products.id')
            ->groupBy('items.orders_id')
            ->get(['items.orders_id', 'orders.create_data', 'orders.customer_name', 'orders.customer_adress', 'orders.customer_comment', Items::raw('SUM(products.price) AS sum')]);

        $date = Orders::with('items')->get();
        dd($infoCheckout->toArray());

        return view('orders');
    }
    public function show($id)
    {
        return view('items', [
            'itemsID' => $id,
        ]);
    }
}
