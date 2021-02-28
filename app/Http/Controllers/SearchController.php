<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    function index(Request $request){
        
        $products = Product::where('name', $request->name)->get();
        return view('product.search', ['products'=>$products]);
    }
    
    /*function autocomplite(Request $request){
        $datas = Product::where('name', $request->name)->get();

        return $http_response_header()->json($datas);
    }*/
}
