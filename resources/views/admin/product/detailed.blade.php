@extends('admin.layouts.main')

@section('content')
<div class="mt-3 ml-2" >
    <a href="/admin" style="color: black; font-size: 16px; text-decoration: none">Dashboard</a>
    <i class="fa fa-angle-right" style="font-size:24px"></i>
    <span><a href="{{ route('admin.products.index') }}" style="color: black; font-size: 16px; text-decoration: none">Products</a></span>
    <i class="fa fa-angle-right" style="font-size:24px"></i>
    <span><a href="{{ route('admin.product.show', $product->id) }}" style="color: black; font-size: 16px; text-decoration: none">View</a></span>
    <i class="fa fa-angle-right" style="font-size:24px"></i>
    <span>{{ $product->name }}</span>
</div>
<div class="container">
    <div class="card flex-row flex-wrap border border-secondary mt-3">
        <div class="card-header border border-danger">
            <img src="{{ asset('storage/public/'.$product->picture) }}" alt="" class="float-left" style="width: 250px">

        </div>
        <div class="card-block px-2 col-lg-8 border border-danger border-right-0">
            <div class="card-title mt-5 border-bottom">
                <h4><a href="{{ route('products.show', $product->id) }}">{{ $product->name }}</a></h4> 
            </div>
            <div class="text text-danger border-bottom"><h3>{{ $product->presentPrice() }}</h3> </div>
            <div class="card-text border-bottom mt-3 mb-2">

                <div class="card-text border-bottom">
                    <p>{{ $product->description }}</p>
                </div>
        </div>
    </div>

</div>
    
@endsection