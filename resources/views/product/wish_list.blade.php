@extends('layouts.main')
@section('content')
@include('flash-message')
    <div class="header"><h2> <b>Your Wish List</b> </h2></div>
    <table id="$wish_list" class="table table-hover table-condensed">
        <thead>
        <tr>
            <th style="width:50%">Product</th>
            <th style="width:10%">Price</th>
            {{-- <th style="width:8%">Quantity</th>
            <th style="width:22%" class="text-center">Subtotal</th> --}}
            <th style="width:10%"></th>
        </tr>
        </thead>
        <tbody>
            @if (count( (array) session('wish_list')) < 1)
            <h4> Your wish list is empty! </h4>
         @endif
        @if(session('wish_list'))
            @foreach(session('wish_list') as $id => $product)
            
              
                <tr>
                    <td data-th="Product">
                        <div class="row">
                            <div class="col-sm-4 hidden-xs"><img src="{{ asset('storage/public/'.$product['picture']) }}" width="80%" height="100"/></div>
                            <div class="col-sm-8">
                                <h5 class="mt-2"><a class="text-dark" href="{{ route('products.show', $id) }}">{{ $product['name'] }}</a></h5>
                                <b>Color :</b> {{ $product['color'] }} <label class="mb-0 rounded-circle" style="width: 12px; height: 12px; background: {{ $product['hex_color'] }}"></label>
                                <b>Size :</b> {{ $product['size'] }} <br>
                                <b>In Stock :</b>{{$product['stock_qty'] }}
                            </div>
                        </div>
                    </td>
                    <td data-th="Price"class="mr-3">${{ $product['price'] }},00</td>
                    
                     <td class="actions" data-th=""> 
                        <form action="{{ route('switchToCart', $id) }}" method="POST">
                            @csrf
                            <button type="submit">Switch to Cart </button>

                        </form>
                        {{-- <a href="{{ route('cart.saveForLater', 'product') }}" class="mt-2">Save for later</a>                      --}}
                        <form action="{{ route('saveForLater.delete', $id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm remove-from-cart mt-1 ml-2" ><i class="fa fa-trash-o"></i></button>
                        </form>   
                    </td>
                </tr>
            @endforeach
        @endif
        </tbody>
        <tfoot>
        <tr class="visible-xs">
            {{-- <td class="text-center"><strong>Total {{ $total }},00</strong></td> --}}
        </tr>
        <tr>
            <td><a href="{{ url('/shop') }}" class="btn btn-warning"><i class="fa fa-angle-left"></i> Continue Shopping</a>
                
            </td>
            {{-- <td colspan="2"><a href="{{ route('checkout') }}" class="btn btn-success">Proceed to Checkout </a> </td> --}}
           
            {{-- <td class="text-center"><strong>Total ${{ $total }},00</strong></td> --}}
            
        </tr>
        </tfoot>
    </table>
@endsection
