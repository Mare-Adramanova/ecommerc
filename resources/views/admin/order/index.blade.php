@extends('admin.layouts.main')

@section('content')
<div class="mt-3 ml-2" >
    <a href="/admin" style="color: black; font-size: 16px; text-decoration: none">Dashboard</a>
    <i class="fa fa-angle-right" style="font-size:24px"></i>
    <span><a href="{{ route('admin.orders.index') }}" style="color: black; font-size: 16px; text-decoration: none">Orders</a></span>
    <a href="{{ route('admin.orders.create') }}" class="btn btn-success ml-3 mb-3">add new</a>
</div>
 
<div class="table-responsive-sm p-2">
<table class="table table-sm table-hover">
    <thead>
        <th> Id </th>
        <th>User id</th>
        <th>Billing email</th>
        <th>Billing name</th>
        <th>Billing address</th>
        <th>Billing city</th>
        <th>Billing postalcode</th>
        <th>Billing phone</th>
        <th>Billing card name</th>
        <th>Billing discount</th>
        <th>Billing discount code</th>
        <th>Billing subtotal</th>
        <th>Billing total</th>
        <th>Payment gateway</th>
        <th>Shipped</th>
        <th>Error</th>
        <th>Action</th>
        
    </thead>
    <tbody>
        
            @foreach ($orders as $order)
                <tr>
                    <td>{{ $order->id }}</td>
                    <td>{{ $order->user_id }}</td>
                    <td>{{ $order->billing_email }}</td>
                    <td>{{ $order->billing_name }}</td>
                    <td>{{ $order->billing_address }}</td>
                    <td>{{ $order->billing_city }}</td>
                    <td>{{ $order->billing_postalcode }}</td>
                    <td>{{ $order->billing_phone }}</td>
                    <td>{{ $order->billing_name_on_card }}</td>
                    <td>{{ $order->billing_discount }}</td>
                    <td>{{ $order->billing_discount_code }}</td>
                    <td>{{ $order->billing_subtotal }}</td>
                    <td>{{ $order->billing_total }}</td>
                    <td>{{ $order->payment_gateway }}</td>
                    <td>{{ $order->shipped }}</td>
                    <td>{{ $order->error }}</td>
                    
                    <td><a href="{{ route('admin.order.show', $order->id) }}" class="btn btn-warning mb-1">view</a>
                    <a href="{{ route('admin.order.edit', $order->id) }}" class="btn btn-primary mb-1">edit</a>
                   
                        <form action="{{ route('admin.order.destroy', $order->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <input type="submit" value="delete" class="btn btn-danger btn-sm">


                        </form>
                    </td>
                </tr>    
            @endforeach
            
        
    </tbody>
    
</table>

</div>
<div class="d-flex justify-content-center">
    {!! $orders->links() !!}
</div> 
@endsection
