<?php

namespace App\Http\Controllers;

use App\Mail\MailSend;
use App\Product;
use DB;
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

        return view('cart', [
            'products' => $products,
        ]);
    }
    public function destroy(Request $request)
    {
        if (isset($request->id)) {
            $idCartProject = $request->id;
            $request->session()->pull('cart.' . $idCartProject);
        }
        return redirect('/cart');
    }
    public function store(Request $request)
    {
        $arrSession = $request->session()->get('cart');
        if (!empty($arrSession)) {
            $request->validate([
                'name' => 'required',
                'contacts' => 'required',
                'comments' => 'required',
            ]);

            $productsSession = Product::whereIn('id', array_values($arrSession))->get();

            $mailTo = \Config::get('values.mail');
         
            Mail::to($mailTo)->send(new MailSend($request, $productsSession));
          
            $idLast = DB::table('orders')->insertGetId([
                'customer_name' => $request->name,
                'customer_adress' => $request->contacts,
                'customer_comment' => $request->comments,
            ]);
            foreach ($arrSession as $item) {
                $priceElement = Product::find($item);
                DB::table('order_product')->insert([
                    'order_id' => $idLast,
                    'product_id' => $item,
                    'price' => $priceElement->price,
                ]);
            }
        }
        return redirect('/cart');
    }
}
