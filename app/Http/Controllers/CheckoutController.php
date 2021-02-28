<?php

namespace App\Http\Controllers;

use App\Models\Color;
use App\Models\ColorProductSize;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Size;
use App\Notifications\PaymentReceived;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Stripe\Charge;
use Stripe\Customer;
use Stripe\Exception\CardException;
use Stripe\Stripe;

class CheckoutController extends Controller
{
    function checkout(){
        //$id = $product->id;
        $cart = session()->get('cart');
        $total = 0;
        if($cart){

        foreach ($cart as $key => $value){
         $total += $cart[$key]['price'] * $cart[$key]['quantity'];
        }}
        $discount = session()->get('coupon')['discount'] ?? 0;
        $newTotal = $total - $discount;
        return view('product.checkout', ['cart'=>$cart, 'discount'=>$discount, 'newTotal'=>$newTotal]);
    }
    
    public function checkoutPost(Request $request)
    { 
        
        //dd($request->all());
        $cart = session()->get('cart');
        
        //dd($cart);
        $total = 0 ;
        foreach ($cart as $key => $value){
            $total += $cart[$key]['price'] * $cart[$key]['quantity'];
        }
       // dd($cart);
        $discount = session()->get('coupon')['discount'] ?? 0;
        //dd(session()->get('coupon')['name']);
        $newTotal = $total - $discount;              
           //dd($newTotal);             
        try {               
            Stripe::setApiKey(env('STRIPE_SECRET'));
            $customer = Customer::create([
                "email" => $request->email,
                "source" => $request->stripeToken

            ]);
           // dd($request->email);
            
            Charge::create ([
                    "customer" => $customer->id,
                    "amount" => $newTotal * 100,
                    "currency" => "usd",
                    "receipt_email"=>$request->email,
                    "description" => "Test payment ",
                    "metadata"=>[
                    
                        'discount'=>$discount

                    ]
            ]);
            
            $order = $this->addToOrdersTables($request, null);

            Session::flash('success', 'Payment successful!');
            $this->decreaseQuantities();
            session()->forget('cart');
            session()->forget('coupon');
            request()->user()->notify(new PaymentReceived());   
            return redirect()->route('products.index');
    } catch (CardException $e){
        $this->addToOrdersTables($request, $e->getMessage());
        return back()->withErrors('Error!'. $e->getMessage());
    } 
    }

    protected function addToOrdersTables($request, $error)
    {
        $cart = session()->get('cart');
        $total = 0 ;
        foreach ($cart as $key => $value){
            $total += $cart[$key]['price'] * $cart[$key]['quantity'];
        }
        //dd($total);
        $discount = session()->get('coupon')['discount'] ?? 0;
        $discount_code = session()->get('coupon')['name'] ?? 0;
        //dd(session()->get('coupon'));
        $newTotal = $total - $discount;              
           //dd($newTotal);             
        // Insert into orders table
        $order = Order::create([
            'user_id' => auth()->user()->id,
            'billing_email' => $request->email,
            'billing_name' => $request->name,
            'billing_address' => $request->address,
            'billing_city' => $request->city,
            'billing_postalcode' => $request->postalcode,
            'billing_phone' => $request->phone,
            'billing_name_on_card' => $request->name_on_card,
            'billing_discount' => $discount,
            'billing_discount_code' => $discount_code,
            'billing_subtotal' => $total,
            'billing_total' => $newTotal,
            'error' => $error,
        ]);

        // Insert into order_product table
        foreach ($cart as $id => $product) {
            OrderProduct::create([
                'order_id' => $order->id,
                'product_id' => $product['product_id'],
                'quantity' => $product['quantity'],
            ]);
        }

        return $order;
    }

    protected function decreaseQuantities()
    {
        $cart = session()->get('cart');
        foreach ($cart as $id => $product) {
            // $color_product_sizes = ColorProductSize::all();
            $size_id = Size::where('name', $product['size'])->first();
            $color_id = Color::where('name', $product['color'])->first();
            $color_product_sizes = ColorProductSize::where('id', $id)->first();
           //$color_product_sizes = ColorProductSize::where('product_id', $id)->where('color_id', $color_id->id)->where('size_id', $size_id->id)->first();
           $color_product_sizes->update(['quantity' => $product['stock_qty'] - $product['quantity']]); 
        }   
    
    }


}
