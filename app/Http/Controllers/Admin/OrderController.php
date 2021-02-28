<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Product;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::simplePaginate(6);
        return view('admin.order.index', compact('orders'));
    }

    public function create()
    {
        $products = Product::all();
        return view('admin.order.create', compact('products'));
    }
    public function store(Request $request, Product $product)
    {
        $request->validate([
            'user_id' => 'required',
            'billing_email' => 'required',
            'billing_name' => 'required',
            'billing_address' => 'required',
            'billing_city' => 'required',
            'billing_postalcode' => 'required',
            'billing_phone' => 'required',
            'billing_name_on_card' => 'required',
            'billing_discount' => 'nullable',
            'billing_discount_code' => 'nullable',
            'billing_subtotal' => 'required',
            'billing_total' => 'required',
            'payment_gateway' => 'nullable',
            'error' => 'nullable'

        ]);
        $order = Order::create($request->all());
        $products = $request->input('products', []);
        $quantities = $request->input('quantities', []);
        for ($product=0; $product < count($products); $product++) {
            if ($products[$product] != '') {
                $order->products()->attach($products[$product], ['quantity' => $quantities[$product]]);
            }
        }
        return redirect()->route('admin.orders.index');
    }

    public function show(Order $order)
    {
        $products = $order->products;
      
        return view('admin.order.detailed', compact('order', 'products'));
    }

    public function edit(Order $order)
    {
        return view('admin.order.edit', compact('order'));
    }

    public function update(Order $order, Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'billing_email' => 'required',
            'billing_name' => 'required',
            'billing_address' => 'required',
            'billing_city' => 'required',
            'billing_postalcode' => 'required',
            'billing_phone' => 'required',
            'billing_name_on_card' => 'required',
            'billing_discount' => 'nullable',
            'billing_discount_code' => 'nullable',
            'billing_subtotal' => 'required',
            'billing_total' => 'required',
            'payment_gateway' => 'nullable',
            'error' => 'nullable'

        ]);
        $order->update($request->all());
        return redirect()->route('admin.orders.index');

    }

    public function destroy(Order $order)
    {
        $order->delete();
        return redirect()->route('admin.orders.index');
    }
}
