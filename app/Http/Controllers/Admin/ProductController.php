<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Color;
use App\Models\Product;
use App\Models\Size;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Request as FacadesRequest;
use Symfony\Component\HttpFoundation\Request as HttpFoundationRequest;

class ProductController extends Controller
{
    public function index()
    {
        
       
        $products = Product::orderBy('created_at', 'desc')->simplePaginate(10);
       
        return view('admin.product.index', ['products'=>$products]);
    }

    function create(){
        $categories = Category::all();
        $colors = Color::all();
        $sizes = Size::all();
        return view('admin.product.create', ['categories' => $categories, 'colors' => $colors, 'sizes' =>$sizes]);
    }

    function store(Request $request){
        //dd($request->all());
        
        $request->validate([
            'name'    =>  'required',
            'price'     =>  'required',
            'description' => 'required',
            'picture'         =>  'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);
      
        $image = $request->file('picture');
        $filename = now()->timestamp .$image->getClientOriginalName();
        
        $image->storeAs('public', $filename);
        
        $product = new Product;
        $product->name = $request->name;
        
        $product->price = $request->price;
        $product->description = $request->description;
        $product->picture = $filename; 
        $product->save();
        foreach($request->othertype as $type){
            if($type != null){
                $explodet_type  = explode(',', $type);
                
          $category = new Category;
         foreach($explodet_type as $explode){
             
             $category = new Category;
             $category->type = $explode;
             $category->save();
             $product->categories()->attach($category);
             $colors = $request->input('colors', []);
             $sizes = $request->input('sizes', []);
             $quantities = $request->input('quantities', []);
            for ($color=0; $color < count($colors); $color++) {
                if ($colors[$color] != '') {
                   
                    $product->color_product_sizes()->create(['product_id'=>$product->id, 'color_id' => $colors[$color], 'size_id'=> $sizes[$color], 'quantity' => $quantities[$color]]);
                }
            }
         }

         
          
      }else{
          $category = Category::find($request['type']);
          
          $product->categories()->attach($category);
          $colors = $request->input('colors', []);
          $sizes = $request->input('sizes', []);
          $quantities = $request->input('quantities', []);
            for ($color=0; $color < count($colors); $color++) {
                if ($colors[$color] != '') {
                   
                    $product->color_product_sizes()->create(['product_id'=>$product->id, 'color_id' => $colors[$color], 'size_id'=> $sizes[$color], 'quantity' => $quantities[$color]]);
                }
            }
     
      }
        }

        return redirect()->route('admin.products.index');
    }

    public function show(Product $product)

    {
        
        return view('admin.product.detailed', ['product'=>$product]);
    }

    public function destroy(Product $product){
        $product->delete();
        return redirect()->back();

    }

    public function edit(Product $product)
    {
        $categories = Category::all();
        // $category = $product->categories->first();
        // $category->type;
        return view('admin.product.edit', compact('product', 'categories'));
    }

    public function update(Product $product, Request $request )
    {
       
       
        $request->validate([
            'name'    =>  'required',
            'price'     =>  'required',
            'description' => 'required',
            'picture'         =>  'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);
        $image = $request->file('picture');
       if($image == ''){
            $image = $request->hidden_picture;
            $product->name = $request->name;
        
            $product->price = $request->price;
            $product->description = $request->description;
            $product->picture = $image; 
    
       }else{
            $filename = now()->timestamp .$image->getClientOriginalName();
        
            $image->storeAs('public', $filename);
            $product->name = $request->name;
            
            $product->price = $request->price;
            $product->description = $request->description;
            $product->picture = $filename; 
        }
            // dd($product->categories);
            if(!$request['type']){
                $categories = $product->categories;
                
                $product->categories()->sync($categories);
            }else{
                $category = Category::find($request['type']);
                $product->categories()->sync($category);
            }
        
            $product->update();
            
            return redirect()->route('admin.products.index');

    }
}
