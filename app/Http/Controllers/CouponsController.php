<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use Illuminate\Http\Request;

class CouponsController extends Controller
{
    public function store(Request $request){
     
       $coupon = Coupon::where('code', $request->coupon_code)->first();
       
       if(!$coupon){
        return redirect()->route('checkout')->with('error', 'Invalid coupon code.Please try again.');
       }
       $cart = session()->get('cart');
       $total = 0;
       foreach ($cart as $key => $value){
        $total += $cart[$key]['price'] * $cart[$key]['quantity'];
       }
       
       session()->put('coupon', [
           'name' => $coupon->code,
           'discount'=> $coupon->discount($total)
       ]);
       return redirect()->route('checkout')->with('success', 'Coupon has been applied!');
    }

    public function destroy(){
        session()->forget('coupon');
        return redirect()->route('checkout')->with('success', 'Coupon has been removed!');

    }
}
