@extends('admin.layouts.main')
{{-- @extends('layouts.main') --}}

@section('content')
    <div class="container-fluid">
        <div class="row mt-3 ml-1">
            <div class="col-md-5 align-self-center">
                <h4>Dashboard</h4> 
            </div>
           
        </div>
       
        <div class="d-flex justify-content-between mb-3 p-3">
            <div class="card bg-info" style="width: 33%">
                <div class="card-header text-center mt-2 text-white card-img-top">
                    <i class="fa fa-users" style='font-size:36px'></i>
                    <h5 class="card-title mt-2">{{ $users->count() }} Users</h5>
                </div> 

                <div class="card-body">
                    <p class="card-text text-center text-white">You have {{ $users->count() }} users in your database.Click on button to view all users</p>
                    <div class="text-center"><a href="{{ route('admin.users.index') }}" class="btn btn-dark stretched-link">View all users</a></div>
                    
                </div>
            </div>
            <div class="card bg-dark" style="width: 33%">
                <div class="card-header text-center mt-2 text-white card-img-top">
                    <i class="fa fa-shopping-bag" style='font-size:36px'></i>
                    <h5 class="card-title mt-2">{{ $products->count() }} Products</h5>
                </div> 
                <div class="card-body">
                    <p class="card-text text-center text-white">You have {{ $products->count() }} products in your database.Click on button to view all products</p>
                    <div class="text-center"><a href="{{ route('admin.products.index') }}" class="btn btn-primary stretched-link">View all products</a></div>
                    
                </div>
                
            </div>
            <div class="card bg-success" style="width: 33%">
                <div class="card-header text-center mt-2 text-white card-img-top">
                    <i class="fa fa-cart-plus" style='font-size:36px'></i>
                    <h5 class="card-title mt-2">{{ $orders->count() }} Orders</h5>
                </div> 
                <div class="card-body">
                    <p class="card-text text-center text-white">You have {{ $orders->count() }} orders in your database.Click on button to view all orders</p>
                    <div class="text-center"><a href="{{ route('admin.orders.index') }}" class="btn btn-dark stretched-link">View all orders</a></div>
                    
                </div>
            </div>
        </div>
    
    </div>

    
@endsection