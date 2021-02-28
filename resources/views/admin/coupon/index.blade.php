@extends('admin.layouts.main')

@section('content')
<div class="mt-3 ml-2" >
    <a href="/admin" style="color: black; font-size: 16px; text-decoration: none">Dashboard</a>
    <i class="fa fa-angle-right" style="font-size:24px"></i>
    <span><a href="{{ route('admin.coupons.index') }}" style="color: black; font-size: 16px; text-decoration: none">Coupons</a></span>
    <a href="{{ route('admin.coupons.create') }}" class="btn btn-success ml-3 mb-3">+ add new</a>
</div>
<div class="table-responsive-sm p-2">
    <table class="table table-sm table-hover">
        <thead>
            <th>id</th>
            <th style="width: 20%">code</th>
            <th style="width: 20%">type</th>
            <th style="width: 20%">value</th>
            <th style="width: 20%">percent_off</th>
            <th>view</th>
            <th>edit</th>
            <th>delete</th>
        </thead>
        <tbody>
                @foreach ($coupons as $coupon)
                    <tr>
                        <td>{{  $coupon->id }}</td>
                        <td>{{  $coupon->code }}</td>
                        <td>{{  $coupon->type }}</td>
                        <td>{{  $coupon->value }}</td>
                        <td>{{  $coupon->percent_off }}</td>
                        <td><a href="{{ route('admin.coupon.show', $coupon->id) }}" class="btn btn-warning">view</a></td>
                        <td><a href="{{ route('admin.coupon.edit', $coupon->id) }}" class="btn btn-primary">edit</a></td>
                        <td>
                            <form action="{{ route('admin.coupon.destroy', $coupon->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <input type="submit" value="delete" class="btn btn-danger">


                            </form>
                        </td>
                    </tr>
                @endforeach
                    
        </tbody>
        
    </table>
</div>
    
@endsection