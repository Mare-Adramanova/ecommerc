<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Product;

use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request){

        $product = Product::findOrFail(request('product_id')); 
 
        $product->comments()->create(['text'=>request('text'), 'rating'=>request('rating')]);
        
        
        return redirect()->route('products.show', ['product'=>$product]);   
     }
  
     public function show(Comment $comment){
        
        //dd($comment);
        $product = Product::findOrFail($comment->product_id);
        $product->comments()->get();
        
        return redirect()->route('product.show', ['product'=>$product]);
  
     }
}
