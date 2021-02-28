@extends('layouts.main')
@section('content')
@include('flash-message')
    <div class="header"><h2> <b>Your Cart</b> </h2></div>
    <table id="cart" class="table table-hover table-condensed">
        <thead>
        <tr>
            <th style="width:50%">Product</th>
            <th style="width:10%">Price</th>
            <th style="width:8%">Quantity</th>
            <th style="width:22%" class="text-center">Subtotal</th>
            <th style="width:10%"></th>
        </tr>
        </thead>
        <tbody>
        <?php $total = 0 ?>
        @if (count( (array) session('cart')) < 1)
           <h4> Your cart is empty! </h4>
        @endif
       
        @if(session('cart'))
            @foreach(session('cart') as $id => $product)
            
                <?php $total += $product['price'] * $product['quantity'] ?>
                <tr>
                    <td data-th="Product">
                        <div class="row">
                            <div class="col-sm-4 hidden-xs"><img src="{{ asset('storage/public/'.$product['picture']) }}" width="80%" height="100"/></div>
                            <div class="col-sm-8">
                                <h5 class="mt-2">
                                    <a class="text-dark" href="{{ route('products.show', $id) }}">{{ $product['name'] }}</a></h5>
                                    <b>Color :</b> {{ $product['color'] }} <label class="mb-0 rounded-circle" style="width: 12px; height: 12px; background: {{ $product['hex_color'] }}"></label>
                                    <b>Size :</b> {{ $product['size'] }} <br>
                                    <b>In Stock :</b>{{$product['stock_qty'] }}
                            </div>
                        </div>
                    </td>
                    <td data-th="Price"class="mr-3">${{ $product['price'] }},00</td>
                    <td data-th="Quantity">
                        <form action="{{ route('cart.update', $id) }}" method="post">
                            @csrf
                            @method('PUT')
                            {{ $product['quantity'] }}
                        <input type="number" name="quantity"  value="" class="form-control quantity" /> 
                        <button type="submit" class="fa fa-refresh btn btn-info btn-sm" ></button>
                        </form>   
                        
                    </td>
                    <td data-th="Subtotal" class="text-center">${{ $product['price'] * $product['quantity'] }},00</td>
                     <td class="actions" > 
                              
                        <form action="{{ route('cart.destroy', $id) }}" method="POST">
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
            <td class="text-center"><strong>Total {{ $total }},00</strong></td>
        </tr>
        <tr>
            <td><a href="{{ url('/shop') }}" class="btn btn-warning"><i class="fa fa-angle-left"></i> Continue Shopping</a>
                
            </td>
            <td colspan="2"><a href="{{ route('checkout') }}" class="btn btn-success">Proceed to Checkout </a> </td>
           
            <td class="text-center"><strong>Total ${{ $total }},00</strong></td>
            
           
        </tr>
        </tfoot>
    </table>
@endsection
