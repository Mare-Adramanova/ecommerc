@extends('admin.layouts.main')

@section('content')
<div class="mt-3 ml-2" >
    <a href="/admin" style="color: black; font-size: 16px; text-decoration: none">Dashboard</a>
    <i class="fa fa-angle-right" style="font-size:24px"></i>
    <span><a href="{{ route('admin.products.index') }}" style="color: black; font-size: 16px; text-decoration: none">Products</a></span>
    <i class="fa fa-angle-right" style="font-size:24px"></i>
    <a href="{{ route('admin.products.edit', $product->id) }}" style="color: black; font-size: 16px; text-decoration: none" >Edit</a>
</div>
    <form action="{{ route('products.update', $product->id) }}" method="POST" class="was-validated m-3" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="">Product name: </label>
            <input type="text" name="name" placeholder="name:" class="form-control" value="{{ $product->name }}">
            @error('name')
                <p class="alert alert-danger">{{ $message}}</p> 
            @enderror
        </div> 
            
        
        <div class="form-group">
            <label for="">Price: </label>
            <input type="text" name="price" placeholder="price" class="form-control" value="{{ $product->price }}">
            @error('price')
                <p class="alert alert-danger">{{ $message}}</p> 
            @enderror
        </div>
    
        <div class="form-group">
            <label for="">Description: </label>
            <input type="text" name="description" placeholder="description" class="form-control" value="{{ $product->description }}">
            @error('description')
                <p class="alert alert-danger">{{ $message}}</p> 
            @enderror
        </div>
        <div class="form-group">
            <img src="{{ asset('storage/public/'.$product->picture) }}" alt="" style="width: 100px">
            <input name="hidden_picture" type="hidden" class="form-control-file " value="{{ $product->picture }}">
            <label>Upload new image :</label>
            <input type="file" name="picture">
            
        </div>
        @error('picture')
        <p class="alert alert-danger">{{ $message}}</p> 
        @enderror
        <hr>
        <div class="form-group">
            Product Categories :
                @if (count($product->categories) < 1)
                    No related categoryes
                @endif
                @foreach ($product->categories as $category)
                    <a href="{{ route('admin.category.show', $category->id) }}" class="btn btn-primary">{{$category->type}}</a>
                @endforeach
            
        </div>
        <hr>
        <div class="form-group">
            <p>Choose new category :</p>
            <ul>
                @foreach ($categories as $category)
                <div class="form-check">
                    <li><input type="checkbox" name="type[]" class="form-check-input" id="check" value="{{$category->id}}" multiple>
                    <label class="form-check-label" for="check" style="color: black">{{ $category->type }}</label></li>
                </div>
                @endforeach
            </ul>
        </div>

        <input type="submit" class="btn btn-primary" value="update">

    </form>
@endsection