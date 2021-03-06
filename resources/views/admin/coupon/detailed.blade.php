@extends('admin.layouts.main')

@section('content')
<div class="mt-3 ml-2" >
    <a href="/admin" style="color: black; font-size: 16px; text-decoration: none">Dashboard</a>
    <i class="fa fa-angle-right" style="font-size:24px"></i>
    <span><a href="{{ route('admin.coupons.index') }}" style="color: black; font-size: 16px; text-decoration: none">Coupons</a></span>
    <i class="fa fa-angle-right" style="font-size:24px"></i>
    <span><a href="{{ route('admin.coupon.show', $coupon->id) }}" style="color: black; font-size: 16px; text-decoration: none">Show</a></span>
    <i class="fa fa-angle-right" style="font-size:24px"></i>
    <span>{{$coupon->code}}</span>
</div>

<div class="table-responsive-sm p-2">
    <table class="table table-sm table-hover">
        <thead>
            <th>id</th>
            <th style="width: 20%">code</th>
            <th style="width: 20%">type</th>
            <th style="width: 20%">value</th>
            <th style="width: 20%">percent_off</th>
            
        </thead>
        <tbody>
              
            <tr>
                <td>{{  $coupon->id }}</td>
                <td>{{  $coupon->code }}</td>
                <td>{{  $coupon->type }}</td>
                <td>{{  $coupon->value }}</td>
                <td>{{  $coupon->percent_off }}</td>
                        
            </tr>
                    
        </tbody>
        
    </table>
</div>
    
@endsection