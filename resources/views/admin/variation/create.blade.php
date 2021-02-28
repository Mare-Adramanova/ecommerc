@extends('admin.layouts.main')

@section('content')
<div class="mt-3 ml-2" >
    <a href="/admin" style="color: black; font-size: 16px; text-decoration: none">Dashboard</a>
    <i class="fa fa-angle-right" style="font-size:24px"></i>
    <span><a href="{{ route('admin.productVariations.index') }}" style="color: black; font-size: 16px; text-decoration: none">Product Variations</a></span>
    <i class="fa fa-angle-right" style="font-size:24px"></i>
    <span><a href="{{ route('admin.productVariations.create') }}" style="color: black; font-size: 16px; text-decoration: none">Create</a></span>
    
</div>

    <form action="{{ route('admin.productVariations.store') }}" method="POST" class="was-validated mt-2 p-2">
        @csrf
        <div class="form-group ml-1">
            <label for="">Product id : </label>
            <input type="text" name="product_id" placeholder="product_id" class="form-control" value="{{ old('product_id') }}">
            @error('product_id')
                <p class="alert alert-danger">{{ $message }}</p> 
            @enderror
        </div> 
        <div class="form-group ml-1">
            <label for="">Color id : </label>
            <input type="text" name="color_id" placeholder="color_id" class="form-control" value="{{ old('color_id') }}">
            @error('color_id')
                <p class="alert alert-danger">{{ $message }}</p> 
            @enderror
        </div> 
        <div class="form-group ml-1">
            <label for="">Size id : </label>
            <input type="text" name="size_id" placeholder="size_id" class="form-control" value="{{ old('size_id') }}">
            @error('size_id')
                <p class="alert alert-danger">{{ $message }}</p> 
            @enderror
        </div>
        <div class="form-group ml-1">
            <label for="">Quantity : </label>
            <input type="text" name="quantity" placeholder="quantity" class="form-control" value="{{ old('quantity') }}">
            @error('quantity')
                <p class="alert alert-danger">{{ $message }}</p> 
            @enderror
        </div>
        

        <input type="submit" class="btn btn-dark mb-5" value="create">

    </form>
    
@endsection