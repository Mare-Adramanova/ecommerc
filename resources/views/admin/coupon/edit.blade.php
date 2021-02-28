@extends('admin.layouts.main')

@section('content')
<div class="mt-3 ml-2" >
    <a href="/admin" style="color: black; font-size: 16px; text-decoration: none">Dashboard</a>
    <i class="fa fa-angle-right" style="font-size:24px"></i>
    <span><a href="{{ route('admin.coupons.index') }}" style="color: black; font-size: 16px; text-decoration: none">Coupons</a></span>
    <i class="fa fa-angle-right" style="font-size:24px"></i>
    <span><a href="{{ route('admin.coupon.edit', $coupon->id) }}" style="color: black; font-size: 16px; text-decoration: none">Edit</a></span>
    
</div>

    <form action="{{ route('admin.coupon.update', $coupon->id) }}" method="POST" class="was-validated mt-2 p-2">
        @csrf
        @method('PUT')
        <div class="form-group ml-1">
            <label for="">Code: </label>
            <input type="text" name="code" placeholder="code:" class="form-control" value="{{ $coupon->code }}">
            @error('code')
                <p class="alert alert-danger">{{ $message }}</p> 
            @enderror
        </div>
        <div class="form-group ml-1">
            <label for="">Type: </label>
            <input type="text" name="type" placeholder="type:" class="form-control" value="{{ $coupon->type }}">
            @error('type')
                <p class="alert alert-danger">{{ $message }}</p> 
            @enderror
        </div> 
        <div class="form-group ml-1">
            <label for="">Value: </label>
            <input type="text" name="value" placeholder="value:" class="form-control" value="{{ $coupon->value }}">
            @error('value')
                <p class="alert alert-danger">{{ $message }}</p> 
            @enderror
        </div>
        <div class="form-group ml-1">
            <label for="">Percent off </label>
            <input type="text" name="percent_off" placeholder="percent_off:" class="form-control" value="{{ $coupon->percent_off }}">
            @error('percent_off')
                <p class="alert alert-danger">{{ $message }}</p> 
            @enderror
        </div>

        <input type="submit" class="btn btn-dark mb-5" value="update">

    </form>
    
@endsection