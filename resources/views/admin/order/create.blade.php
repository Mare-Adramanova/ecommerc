@extends('admin.layouts.main')
@section('extra-java/script')
<script type="text/javascript">
    jQuery(document).ready(function(){
        let row_number = 1;
        $("#add_row").click(function(e){
          e.preventDefault();
          let new_row_number = row_number - 1;
          $('#product' + row_number).html($('#product' + new_row_number).html()).find('td:first-child');
          $('#products_table').append('<tr id="product' + (row_number + 1) + '"></tr>');
          row_number++;
        });
    
        $("#delete_row").click(function(e){
          e.preventDefault();
          if(row_number > 1){
            $("#product" + (row_number - 1)).html('');
            row_number--;
          }
        });
      });
    </script>
@endsection

@section('content')


<div class="mt-3 ml-2" >
    <a href="/admin" style="color: black; font-size: 16px; text-decoration: none">Dashboard</a>
    <i class="fa fa-angle-right" style="font-size:24px"></i>
    <span><a href="{{ route('admin.orders.index') }}" style="color: black; font-size: 16px; text-decoration: none">Orders</a></span>
    <i class="fa fa-angle-right" style="font-size:24px"></i>
    <span><a href="{{ route('admin.orders.create') }}" style="color: black; font-size: 16px; text-decoration: none">Create</a></span>
    
</div>

    <form action="{{ route('admin.order.store') }}" method="POST" class="was-validated mt-2 p-2">
        @csrf
        <div class="form-group ml-1">
            <label for="">User id: </label>
            <input type="text" name="user_id" placeholder="user id" class="form-control" value="{{ old('user_id') }}">
            @error('user_id')
                <p class="alert alert-danger">{{ $message }}</p> 
            @enderror
        </div> 
        <div class="form-group ml-1">
            <label for="">Billing email: </label>
            <input type="text" name="billing_email" placeholder="billing email" class="form-control" value="{{ old('billing_email') }}">
            @error('billing_email')
                <p class="alert alert-danger">{{ $message }}</p> 
            @enderror
        </div>
        <div class="form-group ml-1">
            <label for="">Billing name: </label>
            <input type="text" name="billing_name" placeholder="billing name" class="form-control" value="{{ old('billing_name') }}">
            @error('billing_name')
                <p class="alert alert-danger">{{ $message }}</p> 
            @enderror
        </div>
        <div class="form-group ml-1">
            <label for="">Billing address: </label>
            <input type="text" name="billing_address" placeholder="billing address" class="form-control" value="{{ old('billing_address') }}">
            @error('billing_address')
                <p class="alert alert-danger">{{ $message }}</p> 
            @enderror
        </div>
        <div class="form-group ml-1">
            <label for="">Billing city: </label>
            <input type="text" name="billing_city" placeholder="billing city" class="form-control" value="{{ old('billing_city') }}">
            @error('billing_city')
                <p class="alert alert-danger">{{ $message }}</p> 
            @enderror
        </div>
        <div class="form-group ml-1">
            <label for="">Billing postalcode: </label>
            <input type="text" name="billing_postalcode" placeholder="billing postalcode" class="form-control" value="{{ old('billing_postalcode') }}">
            @error('billing_postalcode')
                <p class="alert alert-danger">{{ $message }}</p> 
            @enderror
        </div>
        <div class="form-group ml-1">
            <label for="">Billing phone: </label>
            <input type="text" name="billing_phone" placeholder="billing phone" class="form-control" value="{{ old('billing_phone') }}">
            @error('billing_phone')
                <p class="alert alert-danger">{{ $message }}</p> 
            @enderror
        </div>
        <div class="form-group ml-1">
            <label for="">Billing name on card: </label>
            <input type="text" name="billing_name_on_card" placeholder="billing name on card" class="form-control" value="{{ old('billing_name_on_card') }}">
            @error('billing_name_on_card')
                <p class="alert alert-danger">{{ $message }}</p> 
            @enderror
        </div>
        <div class="form-group ml-1">
            <label for="">Billing discount: </label>
            <input type="text" name="billing_discount" placeholder="billing discount" class="form-control" value="{{ old('billing_discount') }}">
            @error('billing_discount')
                <p class="alert alert-danger">{{ $message }}</p> 
            @enderror
        </div>
        <div class="form-group ml-1">
            <label for="">Billing discount code: </label>
            <input type="text" name="billing_discount_code" placeholder="billing discount code" class="form-control" value="{{ old('billing_discount_code') }}">
            @error('billing_discount_code')
                <p class="alert alert-danger">{{ $message }}</p> 
            @enderror
        </div>
        <div class="form-group ml-1">
            <label for="">Billing subtotal: </label>
            <input type="text" name="billing_subtotal" placeholder="billing subtotal" class="form-control" value="{{ old('billing_subtotal') }}">
            @error('billing_subtotal')
                <p class="alert alert-danger">{{ $message }}</p> 
            @enderror
        </div>
        <div class="form-group ml-1">
            <label for="">Billing total: </label>
            <input type="text" name="billing_total" placeholder="billing total" class="form-control" value="{{ old('billing_total') }}">
            @error('billing_total')
                <p class="alert alert-danger">{{ $message }}</p> 
            @enderror
        </div>
        <div class="form-group ml-1">
            <label for="">Payment gateway: </label>
            <input type="text" name="payment_gateway" placeholder="payment gateway" class="form-control" value="{{ old('payment_gateway') }}">
            @error('payment_gateway')
                <p class="alert alert-danger">{{ $message }}</p> 
            @enderror
        </div>
        <div class="form-group ml-1">
            <label for="">Error: </label>
            <input type="text" name="error" placeholder="error" class="form-control" value="{{ old('error') }}">
            @error('error')
                <p class="alert alert-danger">{{ $message }}</p> 
            @enderror
        </div>

        <div class="card-body">
            <table class="table" id="products_table">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Quantity</th>
                    </tr>
                </thead>
                <tbody>
                    <tr id="product0">
                        <td>
                            <select name="products[]" class="form-control">
                                <option value="">-- choose product --</option>
                                @foreach ($products as $product)
                                    <option value="{{ $product->id }}">
                                        {{ $product->name }} (${{ $product->presentPrice() }})
                                    </option>
                                @endforeach
                            </select>
                        </td>
                        <td>
                            <input type="number" name="quantities[]" class="form-control" value="1" />
                        </td>
                    </tr>
                    <tr id="product1"></tr>
                </tbody>
            </table>
            <div class="row">
                <div class="col-md-12">
                    <button id="add_row" class="btn btn-default pull-left">+ Add Row</button>
                    <button id='delete_row' class="pull-right btn btn-danger">- Delete Row</button>
                </div>
            </div>
        </div>

        <input type="submit" class="btn btn-dark mb-5" value="{{ 'save' }}">

    </form>
    
@endsection