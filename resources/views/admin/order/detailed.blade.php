@extends('admin.layouts.main')

@section('content')
<div class="mt-3 ml-2" >
    <a href="/admin" style="color: black; font-size: 16px; text-decoration: none">Dashboard</a>
    <i class="fa fa-angle-right" style="font-size:24px"></i>
    <span><a href="{{ route('admin.orders.index') }}" style="color: black; font-size: 16px; text-decoration: none"> Orders</a></span>
    <i class="fa fa-angle-right" style="font-size:24px"></i>
    <span><a href="{{ route('admin.order.show', $order->id) }}" style="color: black; font-size: 16px; text-decoration: none">Viewing order</a></span>
    <i class="fa fa-angle-right" style="font-size:24px"></i>
    <span>{{ $order->id }}</span>
</div>
@foreach ($products as $product)
<div class="container">
    
    <div class="card flex-row flex-wrap border border-secondary mt-3">
        
        <div class="card-header border border-danger">
            <img src="{{ asset('storage/public/'.$product->picture) }}" alt="" class="float-left" style="width: 150px">

        </div>
        <div class="card-block px-2 col-lg-8 border border-danger border-right-0">
            <div><b> Product Id: {{ $product->id }}</b></div>
            <div class="card-title mt-5 border-bottom">
                <b>Name : <a href="{{ route('products.show', $product->id) }}">{{ $product->name }}</a></b> 
            </div>
            <div class="text text-danger border-bottom"><b>Price : {{ $product->presentPrice() }}</b> </div>
            <div class="card-text border-bottom mt-3 mb-2">

                <div class="card-text border-bottom">
                    <p><b>Description : {{ $product->description }}</b></p>
                </div>
                <div><b> Product Quantity: {{ $product->pivot->quantity }}</b></div>
        </div>
    </div>
    
</div>
@endforeach

<hr>
<div class="mt-3">
    <h4>Order details: </h4>
    <ul class="list-group">
        
        <li class="list-group-item"><b>Id</b><br> {{ $order->id }}</li>
        <li class="list-group-item"><b>User Id</b><br> {{ $order->user_id }}</li>
        <li class="list-group-item"><b>Billing email</b><br> {{ $order->billing_email }}</li>
        <li class="list-group-item"><b>Billing name</b><br> {{ $order->billing_name }}</li>
        <li class="list-group-item"><b>Billing address</b><br> {{ $order->billing_address }}</li>
        <li class="list-group-item"><b>Billing city</b><br> {{ $order->billing_city }}</li>
        <li class="list-group-item"><b>Billing postalcode</b><br> {{ $order->billing_postalcode }}</li>
        <li class="list-group-item"><b>Billing phone</b><br> {{ $order->billing_phone }}</li>
        <li class="list-group-item"><b>Billing card name</b><br> {{ $order->billing_name_on_card }}</li>
        <li class="list-group-item"><b>Billing discount</b><br> {{ $order->billing_discount }}</li>
        <li class="list-group-item"><b>Billing discount code</b><br> {{ $order->billing_discount_code }}</li>
        <li class="list-group-item"><b>Billing subtotal</b><br> {{ $order->billing_subtotal }}</li>
        <li class="list-group-item"><b>Billing total</b><br> {{ $order->billing_total }}</li>
        <li class="list-group-item"><b>Payment gateway</b><br> {{ $order->payment_gateway }}</li>
        <li class="list-group-item"><b>Shipped</b><br> {{ $order->shipped }}</li>
        <li class="list-group-item"><b>Error</b><br> {{ $order->error }}</li>
            
    </ul>
              
    </div>
    
@endsection