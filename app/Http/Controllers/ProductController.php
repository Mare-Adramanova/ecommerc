<?php

namespace App\Http\Controllers;

use App\Models\Average;
use App\Models\AverageModel;
use App\Models\Category;
use App\Models\ColorProductSize;
use App\Models\Comment;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Symfony\Component\Console\Helper\Table;

class ProductController extends Controller
{
    
    function index(){
        if(request('category')){
           // dd(request('category'));
            $products = Category::where('type', request('category'))->firstOrFail()->products;
            //dd($products);
            $categories = Category::all();
            $comments = Comment::all();
            $averages = Average::all();
            $hidden = true;
        }elseif(request('average')){
          //dd(request()->all());
           $products = Product::all()->random(8);
           $products = Average::where('value', request('average'))->firstOrFail()->products;
           $averages = Average::all();
           
            $categories = Category::all();
            $comments = Comment::all();
            $hidden = true;
           
        }
        else{

            $products = Product::all()->random(8);
            $comments = Comment::all();
            
            $averages = Average::all();
           
            $categories = Category::all();
           
            $hidden = false;
        }
        if(request('sort') === 'low_high'){
            $products = Product::all();
            $products = $products->sortBy('price');
            $hidden = true;
        }elseif(request('sort') === 'high_low'){
            $products = Product::all();
            $products = $products->sortByDesc('price');
            $hidden = true;
        }
        
        return view('product/index', ['products'=>$products, 'categories'=>$categories, 'comments'=>$comments, 'averages'=>$averages, 'hidden'=>$hidden]);
    }

    

    

    function show(Product $product){
        $categories = Product::where('id', $product->id)->firstOrFail()->categories;
        
        foreach($categories as $category){
            $category = $category;
        }
        $total = $product->comments()->count('rating');
        
        $total5 = $product->comments()->where('rating', '5')->count();
        if($total5 == 0){ 
            $rate_5 = 0;
            $stars_5 = 0;
         }else{
            $rate_5 = ($total5 / $total) * 100;
             $stars_5 = number_format($rate_5);
         }
        
        $total4 = $product->comments()->where('rating', '4')->count();
        if($total4 == 0){
            $rate_4 = 0;
            $stars_4 = 0;
        }else{
            $rate_4 = ($total4 / $total) * 100;
            $stars_4 = number_format($rate_4);

        }
        
        $total3 = $product->comments()->where('rating', '3')->count();
        if($total3 == 0){
            $rate_3 = 0;
            $stars_3 = 0;
        }else{
            $rate_3 = ($total3 / $total) * 100;
            $stars_3 = number_format($rate_3);
        }
        
        $total2 = $product->comments()->where('rating', '2')->count() ;
        if($total2 == 0){
            $rate_2 = 0;
            $stars_2 = 0;
        }else{
            $rate_2 = ($total2 / $total) * 100;
            $stars_2 = number_format($rate_2);
        }
        
        $total1 = $product->comments()->where('rating', '1')->count();
        if($total1 == 0){
            $rate_1 = 0;
            $stars_1 = 0;
        }else{
            $rate_1 = ($total1 / $total) * 100;
            $stars_1 = number_format($rate_1);
        }
        
        
        
        $avg_ratings = $product->comments()->avg('rating');
        $rating = number_format($avg_ratings);
       
        $average = Average::find($rating);
       
        $product->averages()->sync($average);
      
        
        $product['rating'] = $rating;
        $product['stars_5'] = $stars_5.'%';
        $product['stars_4'] = $stars_4.'%';
        $product['stars_3'] = $stars_3.'%';
        $product['stars_2'] = $stars_2.'%';
        $product['stars_1'] = $stars_1.'%';

        $color_product = $product->color_product_sizes()->distinct('color_id')->get('color_id'); 
   
        return view('product.detailed', ['product'=>$product, 'category'=>$category ?? "", 'color_product'=>$color_product]);
        

    }

    function shop(){
        
        $hidden = true;
        $categories = Category::all();
        $products = Product::simplePaginate(16);
        $averages = Average::all();
        
        return view('product.index', ['products'=>$products, 'categories'=>$categories, 'averages'=>$averages, 'hidden'=>$hidden]);
    }

    function review(){
        
        return view('product.review');
        
    }

   

    

    
}
