@extends('layouts.main')

@section('content')
<div class="container">
    {{-- <div class="row justify-content-center">
        <div class="col-md-10"> --}}
            <div class="mt-3 ml-2" >
                <a href="/" style="color: black; font-size: 16px; text-decoration: none">Home</a>
                <i class="fa fa-angle-right" style="font-size:24px"></i>
                <span><a href="{{ url('/home') }}" style="color: black; font-size: 16px; text-decoration: none">My profile</a></span>
            </div>
            <hr>
            <div class="container row">
                <div class="sidebar float-left col-md-3" id="sidebar">

                    <ul class="list-group list-group-flush">
                      <li class="list-group-item"><a href="{{ url('/home') }}" class="text-dark stretched-link" >My Profile</a></li>
                      <li class="list-group-item"><a href="{{ route('orders.index') }}">My Orders</a></li>
                    </ul>
                </div> 
                <div class="my-profile col-md-9">
                    <div>
                        <h2>My Orders</h2>
                    </div>
                    <div>
                        @foreach ($orders as $order)
                            <div>{{ $order->id }}</div>
                            <div>${{ $order->billing_total }},00</div>
                            @foreach ($order->products as $product)
                            <div>
    
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
                                
                            </div>
                                
                            @endforeach
                            <hr>
                        @endforeach
                        
                    </div>
                    
                </div>
            </div>
        {{-- </div> --}}
    {{-- </div>--}}
</div> 
@endsection
<style type="text/css">
#sidebar ul li a{
    
    color: black !important;
    
    
  }
#sidebar ul li a:hover{
    background-color: white !important;
    color: black !important;
    
  }

</style>
