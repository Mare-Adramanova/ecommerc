<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OrdersController extends Controller
{
    public function index()
    {
      
        $orders = auth()->user()->orders()->with('products')->get();

        return view('my-orders')->with('orders', $orders);
    }
}
