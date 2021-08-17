<?php

namespace App\Http\Controllers;

use App\Mail\MailSend;
use App\Products;
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
        $products = $request->session()->has('cart') ? Products::whereIn('id', $addCartProductId)->get() : Products::whereIn('id', -1)->get();
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
        $request->validate([
            'name' => 'required',
            'contacts' => 'required',
            'comments' => 'required',
        ]);

        $productsSession = Products::whereIn('id', array_values($arrSession))->get();

        $emailTo = env('MAIL_TO_ADDRESS');
        Mail::to($emailTo)->send(new MailSend($request, $productsSession));

        $idLast = DB::table('orders')->insertGetId([
            'customer_name' => $request->name,
            'customer_adress' => $request->contacts,
            'customer_comment' => $request->comments,
        ]);
        foreach ($arrSession as $item) {
            DB::table('order')->insert([
                'orders_id' => $idLast,
                'products_id' => $item,
            ]);
        }

        return redirect('/cart');
    }
}
