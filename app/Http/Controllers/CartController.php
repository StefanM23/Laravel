<?php

namespace App\Http\Controllers;

use App\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactMe;
class CartController extends Controller
{
    public function index(Request $request)
    {
        if ($request->session()->has('cart')) {
            $addCartProductId = $request->session()->get('cart');
        }
        $products = $request->session()->has('cart') ? Products::whereIn('id', $addCartProductId)->get() : Products::all();
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
        $request->validate([
            'name' => 'required',
            'contacts' => 'required',
            'comments' => 'required',
        ]);

        $email = env('MAIL_TO_ADDRESS');
        $subject = 'Subject';
        $data = ['value' => 'exemple'];

        Mail::send('mail', $data, function ($message) use ($email, $subject) {
            $message->from('exemple@demo.com', 'name');
            $message->to($email)->subject($subject);
        });
        return view('mail');
    }
}
