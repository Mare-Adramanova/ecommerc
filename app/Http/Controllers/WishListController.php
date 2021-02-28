<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class WishListController extends Controller
{
     ///////
    // product save for later

    public function store(Product $product, $color, $size, $stock){
        dd($color);
        dd($product);
        $id = $product->id;
        if(!$product) {
            abort(404);
        }
        $wish_list = session()->get('wish_list');
       
        if(!$wish_list) {
            $wish_list = [
                    $id => [
                        "name" => $product->name,
                        "quantity" => 1,
                        "price" => $product['price'] / 100,
                        "picture" => $product->picture
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
                "name" => $product->name,
                "quantity" => 1,
                "price" => $product->price / 100,
                "picture" => $product->picture
                ];
                session()->put('wish_list', $wish_list);
              
                return redirect('/wish_list')->with('success', 'Product switch to wish list successfully!');
           
        

    }

    public function destroy($id){
      
            $wish_list = session()->get('wish_list');
            if(isset($wish_list[$id])) {
                unset($wish_list[$id]);
                session()->put('wish_list', $wish_list);
            }
            session()->flash('success', 'Product removed successfully');
        
        return redirect('/wish_list');
     
    }

}
