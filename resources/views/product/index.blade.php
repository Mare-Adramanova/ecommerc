
@extends('layouts.main')

@section('content')
<div class="col-lg-2 float-left">
    <div>
         @include('/partials/sidebar') 
    </div>
</div> 

@if ($hidden === true || Route::currentRouteName() === 'shop')

    <div class="imgcontainer" style="display: none">
        <img src="{{ asset("http://www.fashionstandard.us/wp-content/uploads/2018/09/Accommodating-The-Need-For-Big-and-Beautiful-Clothes-for-Women.jpg") }}" style="width: 100%" alt="">

    </div>
   
@else

<div class="imgcontainer col-md-10 float-left" style="display: block">
    <img src="{{ asset("http://www.fashionstandard.us/wp-content/uploads/2018/09/Accommodating-The-Need-For-Big-and-Beautiful-Clothes-for-Women.jpg") }}" style="width: 100%" alt="">


</div>

@endif
     

    <div class="featured-section">

        <div class="container">
            @if ($hidden === true || Route::currentRouteName() === 'shop')
                <h1 class="text-center mt-5" style="display: none">Laravel E Commerc Example</h1>

                <p class="section-description" style="display: none">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolore vitae nisi, consequuntur illum dolores cumque pariatur quis provident deleniti nesciunt officia est reprehenderit sunt aliquid possimus temporibus enim eum hic.</p>

                <div class="text-center button-container" style="display: none">
                    <a href="#" class="btn btn-dark">Featured</a>
                    <a href="#" class="btn btn-dark">On Sale</a>
                </div>
                
            @else
                <h1 class="text-center mt-5" style="display: block">Laravel E Commerc Example</h1>

                <p class="section-description" style="display: block">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolore vitae nisi, consequuntur illum dolores cumque pariatur quis provident deleniti nesciunt officia est reprehenderit sunt aliquid possimus temporibus enim eum hic.</p>

                <div class="text-center button-container" style="display: block">
                    <a href="#" class="btn btn-dark">Featured</a>
                    <a href="#" class="btn btn-dark">On Sale</a>
                </div>
                
            @endif
            
            @if (request('category'))
                <h3 class="mt-3" style="color: red">{{ request('category') }}<h3>
                    
            @endif
            @if (request('average'))
                <h3 class="mt-3" style="color: red">{{ request('average') }} stars rating<h3>
            @endif
            @if (request('sort'))
                <h3 class="mt-3" style="color: red">{{ request('sort') }} <h3>
            @endif
            <div class="row mb-5 mt-2 text-center">
               
                @foreach ($products as $product)
                
                    <div class="col-3 pt-1 pb-5 card ">
                        <div class="card-header">
                            <a href="{{ route('products.show', $product->id) }}"><img src="{{ asset('storage/public/'.$product->picture) }}"  alt="product" style="width: 140px"></a>
                        </div>
                        <div class="card-body">
                            <div class="card-title">
                                <h6><a href="{{ route('products.show', $product->id) }}">{{ $product->name }}</a></h6>
                                <div class="product-price">{{ $product->presentPrice() }}</div>

                            </div>

                        </div>
                        
                    </div>
                @endforeach
               
                
            </div> <!-- end products -->
            @if (Route::currentRouteName() === 'shop')
            <div class="text-center mb-5">{{ $products->links() }}</div>
            @endif
            <div class="text-center button-container mb-5">
            <a href="{{ route('shop') }}" class="btn btn-danger">View more products</a>
            </div>
            
        </div> <!-- end container -->

    </div> <!-- end featured-section -->


@endsection



