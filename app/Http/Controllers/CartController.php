<?php

namespace App\Http\Controllers;

use App\Models\Color;
use App\Models\ColorProductSize;
use App\Models\Product;
use App\Models\Size;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Product $product, Request $request)
    {
       
         
        $size = Size::where('id', $request->size_id[2])->first();
        $size_name = $size->name;
        $color = Color::where('id', $request->color_name)->first();
        $color_name = $color->name;
        $hex_color = $color->hex_color;
        $stock = ColorProductSize::where('product_id', $product->id)->where('color_id', $request->color_name)
                                 ->where('size_id', $request->size_id[2])->first();
        $stock_qty = $stock->quantity;
        $id = $stock->id;
        if($request->saveForLater == "Save for later"){
            if(!$product) {
                abort(404);
            }
            $wish_list = session()->get('wish_list');
            
            if(!$wish_list) {
                $wish_list = [
                        $id => [
                            "product_id"=> $product->id,
                            "name" => $product->name,
                            "quantity" => 1,
                            "price" => $product['price'] / 100,
                            "picture" => $product->picture,
                            "color" => $color_name,
                            "size" =>$size_name,
                            "hex_color"=> $hex_color,
                            "stock_qty"=> $stock_qty
                        ]
                ];
                session()->put('wish_list', $wish_list);
                
                return redirect('/wish_list')->with('success', 'Product added to wish_list successfully!');
            }
                if(isset($wish_list[$id])) {
                   
                       $wish_list[$id]['quantity']++;
                        session()->put('wish_list', $wish_list);
                       
                        return redirect('/wish_list')->with('success', 'Product is alredy added in your wish list successfully!');
                }  
                    // if item not exist in wish list then add to wish list with quantity = 1
                $wish_list[$id] = [
                    "product_id"=> $product->id,
                    "name" => $product->name,
                    "quantity" => 1,
                    "price" => $product->price / 100,
                    "picture" => $product->picture,
                    "color" => $color_name,
                    "size" =>$size_name,
                    "hex_color"=> $hex_color,
                    "stock_qty"=> $stock_qty
                    ];
                    session()->put('wish_list', $wish_list);
                  
                    return redirect('/wish_list')->with('success', 'Product switch to wish list successfully!');
          
        }
            /////add to cart /////
        
            if(!$product) {
                abort(404);
            }
            
            $cart = session()->get('cart');
           
            // if cart is empty then this the first product
           
            if(!$cart) {
                $cart = [
                        $id => [
                            "product_id"=> $product->id,
                            "name" => $product->name,
                            "quantity" => 1,
                            "price" => $product['price'] / 100,
                            "picture" => $product->picture,
                            "color" => $color_name,
                            "size" =>$size_name,
                            "hex_color"=> $hex_color,
                            "stock_qty"=> $stock_qty
                        ]
                ];
                session()->put('cart', $cart);
                return redirect('/cart')->with('success', 'Product added to cart successfully!');
            }
            // if cart not empty then check if this product exist then increment quantity
            if(isset($cart[$id]) && $cart[$id]['color'] == $color_name) {
               
                
                $cart[$id]['quantity']++;
                session()->put('cart', $cart);
                
                return redirect('/cart')->with('success', 'Product is alredy added in cart successfully!');
            }
            // if item not exist in cart then add to cart with quantity = 1
            $cart[$id] = [
                "product_id"=> $product->id,
                "name" => $product->name,
                "quantity" => 1,
                "price" => $product->price / 100,
                "picture" => $product->picture,
                "color" => $color_name,
                "size" =>$size_name,
                "hex_color"=> $hex_color,
                "stock_qty"=> $stock_qty
            ];
            session()->put('cart', $cart);
            
            return redirect('/cart')->with('success', 'Product added to cart successfully!');
       
       
    }

    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
      
        public function update($id, Request $request)
        {
            
            $cart = session()->get('cart');
            
            $cart[$id]["quantity"] += $request->quantity;
            session()->put('cart', $cart);
            session()->flash('success', 'Cart updated successfully');
            return redirect('/cart');
          
        }
    
    

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
            $cart = session()->get('cart');
            
            if(isset($cart[$id])) {
                unset($cart[$id]);
                session()->put('cart', $cart);
            }
            session()->flash('success', 'Product removed successfully');
        
        return redirect('/cart');
        
    }

    public function switchToCart($id){

      
            $wish_list = session()->get('wish_list');
            $value = $wish_list[$id];
               
            if(isset($wish_list[$id])) {
                unset($wish_list[$id]);
                session()->put('wish_list', $wish_list);
            }
            ///insert product in cart

            $cart = session()->get('cart');
            if(!$cart) {
                $cart[$id] = $value;

            session()->put('cart', $cart);

            return redirect('/wish_list')->with('success', 'Product switch to cart successfully!');
            }if(isset($cart[$id])) {
                 $cart[$id]['quantity']++;
                    session()->put('cart', $cart);
                    
                    return redirect('/wish_list')->with('success', 'Product is alredy added in your cart successfully!');
                }
             // if item not exist in cart then add to cart with quantity = 1
             $cart[$id] = $value;
             session()->put('cart', $cart);
            
             return redirect('/wish_list')->with('success', 'Product switch to cart successfully!');    

       
    }
    


   /* public function saveForLater(Product $product, Request $request){
       // dd($request);
       if($product) {
                $cart = collect(session()->get('cart'));
               // dd($cart);
                $value = $cart[$product->id];
                $id = $product->id;
                //dd($id);
               // $value = $cart['id'];
                //dd($value);
                    if(isset($cart[$product->id])) {
                        unset($cart[$product->id]);
                        session()->put('cart', $cart);
                    }
                   // dd($cart);
                   /*if($cart['id'] == 35){
                        unset($cart['id']);
                        session()->put('cart', $cart);
                    }*/
      // dd($cart);
        //dd($product->name);
       // $switched_cart = $product->where($cart[$id]['name'], $product->name)->get();
        //dd($switched_cart);
              
               // $cart['id'] = $id;
      // $cart = collect(session()->get('cart'))->where($cart['id'], $id);
       //dd($cart);
        //$value = $request->session()->pull($cart['id'], $product);
        //dd($value);
        //$cart['id'] = $product->id;
        //dd($cart['id']);
        //dd($cart);
        //dd($product);
       
        // foreach($cart as $id => $products){
        //     $cart_id = $cart[$id];
        //     dd($cart_id);
        //    // dd($cart[$id]['name']);
        //    // dd($cart[$id]['name']);
        //    $cart_product = $products['name'];
        //     $value = collect(session()->get('cart'))->where($cart[$id]['name'], $product->id)->first($products[$id])->pull('name');
        // }
        
            
           // dd($value);

              /*   $wish_list = session()->get('wish_list');
                
                if(!$wish_list) {
                            $wish_list[$id] = $value;

                    session()->put('wish_list', $wish_list);

                    return redirect('/cart')->with('success', 'Product switch to wish list successfully!');
                } if(isset($wish_list[$id])) {
                // $wish_list[$id]['quantity']++;
                    session()->put('wish_list', $wish_list);
                    
                    return redirect('/cart')->with('success', 'Product is alredy added in your wish list successfully!');
                }
                // if item not exist in wish list then add to wish list with quantity = 1
                $wish_list[$id] = $value;
                session()->put('wish_list', $wish_list);
               // dd($wish_list);
                return redirect('/cart')->with('success', 'Product switch to wish list successfully!');
            }
      
    }*/


}
