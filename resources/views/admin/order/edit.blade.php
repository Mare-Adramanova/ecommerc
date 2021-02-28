@extends('admin.layouts.main')

@section('content')
<div class="mt-3 ml-2" >
    <a href="/admin" style="color: black; font-size: 16px; text-decoration: none">Dashboard</a>
    <i class="fa fa-angle-right" style="font-size:24px"></i>
    <span><a href="{{ route('admin.orders.index') }}" style="color: black; font-size: 16px; text-decoration: none">Orders</a></span>
    <i class="fa fa-angle-right" style="font-size:24px"></i>
    <span><a href="{{ route('admin.order.edit', $order->id) }}" style="color: black; font-size: 16px; text-decoration: none">Edit</a></span>
    
</div>

    <form action="{{ route('admin.order.update', $order->id) }}" method="POST" class="was-validated mt-2 p-2">
        @csrf
        @method('PUT')
        <div class="form-group ml-1">
            <label for="">User id: </label>
            <input type="text" name="user_id" placeholder="user id" class="form-control" value="{{ $order->user_id }}">
            @error('user_id')
                <p class="alert alert-danger">{{ $message }}</p> 
            @enderror
        </div> 
        <div class="form-group ml-1">
            <label for="">Billing email: </label>
            <input type="text" name="billing_email" placeholder="billing email" class="form-control" value="{{ $order->billing_email }}">
            @error('billing_email')
                <p class="alert alert-danger">{{ $message }}</p> 
            @enderror
        </div>
        <div class="form-group ml-1">
            <label for="">Billing name: </label>
            <input type="text" name="billing_name" placeholder="billing name" class="form-control" value="{{ $order->billing_name }}">
            @error('billing_name')
                <p class="alert alert-danger">{{ $message }}</p> 
            @enderror
        </div>
        <div class="form-group ml-1">
            <label for="">Billing address: </label>
            <input type="text" name="billing_address" placeholder="billing address" class="form-control" value="{{ $order->billing_address }}">
            @error('billing_address')
                <p class="alert alert-danger">{{ $message }}</p> 
            @enderror
        </div>
        <div class="form-group ml-1">
            <label for="">Billing city: </label>
            <input type="text" name="billing_city" placeholder="billing city" class="form-control" value="{{ $order->billing_city }}">
            @error('billing_city')
                <p class="alert alert-danger">{{ $message }}</p> 
            @enderror
        </div>
        <div class="form-group ml-1">
            <label for="">Billing postalcode: </label>
            <input type="text" name="billing_postalcode" placeholder="billing postalcode" class="form-control" value="{{ $order->billing_postalcode }}">
            @error('billing_postalcode')
                <p class="alert alert-danger">{{ $message }}</p> 
            @enderror
        </div>
        <div class="form-group ml-1">
            <label for="">Billing phone: </label>
            <input type="text" name="billing_phone" placeholder="billing phone" class="form-control" value="{{ $order->billing_phone }}">
            @error('billing_phone')
                <p class="alert alert-danger">{{ $message }}</p> 
            @enderror
        </div>
        <div class="form-group ml-1">
            <label for="">Billing name on card: </label>
            <input type="text" name="billing_name_on_card" placeholder="billing name on card" class="form-control" value="{{ $order->billing_name_on_card }}">
            @error('billing_name_on_card')
                <p class="alert alert-danger">{{ $message }}</p> 
            @enderror
        </div>
        <div class="form-group ml-1">
            <label for="">Billing discount: </label>
            <input type="text" name="billing_discount" placeholder="billing discount" class="form-control" value="{{ $order->billing_discount }}">
            @error('billing_discount')
                <p class="alert alert-danger">{{ $message }}</p> 
            @enderror
        </div>
        <div class="form-group ml-1">
            <label for="">Billing discount code: </label>
            <input type="text" name="billing_discount_code" placeholder="billing discount code" class="form-control" value="{{ $order->billing_discount_code }}">
            @error('billing_discount_code')
                <p class="alert alert-danger">{{ $message }}</p> 
            @enderror
        </div>
        <div class="form-group ml-1">
            <label for="">Billing subtotal: </label>
            <input type="text" name="billing_subtotal" placeholder="billing subtotal" class="form-control" value="{{ $order->billing_subtotal }}">
            @error('billing_subtotal')
                <p class="alert alert-danger">{{ $message }}</p> 
            @enderror
        </div>
        <div class="form-group ml-1">
            <label for="">Billing total: </label>
            <input type="text" name="billing_total" placeholder="billing total" class="form-control" value="{{ $order->billing_total }}">
            @error('billing_total')
                <p class="alert alert-danger">{{ $message }}</p> 
            @enderror
        </div>
        <div class="form-group ml-1">
            <label for="">Payment gateway: </label>
            <input type="text" name="payment_gateway" placeholder="payment gateway" class="form-control" value="{{ $order->payment_gateway }}">
            @error('payment_gateway')
                <p class="alert alert-danger">{{ $message }}</p> 
            @enderror
        </div>
        <div class="form-group ml-1">
            <label for="">Error: </label>
            <input type="text" name="error" placeholder="error" class="form-control" value="{{ $order->error }}">
            @error('error')
                <p class="alert alert-danger">{{ $message }}</p> 
            @enderror
        </div>

        <input type="submit" class="btn btn-dark mb-5" value="create">

    </form>
    
@endsection