<?php

namespace App\Http\Controllers;

use App\Mail\MailSend;
use App\Order;
use App\OrderProduct;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class CartController extends Controller
{
    public function index(Request $request)
    {

        if ($request->session()->has('cart')) {
            $addCartProductId = $request->session()->get('cart');
        }

        $products = $request->session()->has('cart') ? Product::whereIn('id', $addCartProductId)->get() : Product::whereIn('id', [-1])->get();
        
        return response()->json($products->toArray());
        return view('cart', [
            'products' => $products,
        ]);
    }
    public function destroy(Request $request)
    {
        dump($request->id);
        if (isset($request->id)) {
            $idCartProject = $request->id;
            $request->session()->pull('cart.' . $idCartProject);
        }
        return response()->json([], 204);
        return redirect()->route('cart.index');
    }
    public function store(Request $request)
    {
        $arrayCartIdSession = $request->session()->get('cart');
        if (!empty($arrayCartIdSession)) {
            $request->validate([
                'name' => 'required',
                'contacts' => 'required',
                'comments' => 'required',
            ]);

            $productsSession = Product::whereIn('id', array_values($arrayCartIdSession))->get();

            $mailTo = \Config::get('values.mail');

            Mail::to($mailTo)->send(new MailSend($request, $productsSession));

            $orderInsert = Order::create([
                'customer_name' => strip_tags($request->name),
                'customer_address' => strip_tags($request->contacts),
                'customer_comment' => strip_tags($request->comments),
            ]);
            foreach ($arrayCartIdSession as $productIdFromCart) {
                $priceElement = Product::find($productIdFromCart);
                OrderProduct::create([
                    'order_id' => $orderInsert->id,
                    'product_id' => $productIdFromCart,
                    'price' => $priceElement->price,
                ]);
            }
        }
        return redirect()->route('cart.index');
    }
}
