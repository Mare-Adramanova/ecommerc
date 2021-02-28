@extends('admin.layouts.main')

@section('content')
<div class="mt-3 ml-2" >
    <a href="/admin" style="color: black; font-size: 16px; text-decoration: none">Dashboard</a>
    <i class="fa fa-angle-right" style="font-size:24px"></i>
    <span><a href="{{ route('admin.categories.index') }}" style="color: black; font-size: 16px; text-decoration: none">Categories</a></span>
    <i class="fa fa-angle-right" style="font-size:24px"></i>
    <span><a href="{{ route('admin.category.edit', $category->id) }}" style="color: black; font-size: 16px; text-decoration: none">Edit</a></span>
    
</div>
<form action="{{ route('admin.category.update', $category->id) }}" method="POST" class="was-validated m-3">
    @csrf
    @method('PUT')

    <div class="form-group">
        <label for="">Category type: </label>
    <input type="text" name="type" placeholder="type:" class="form-control" value="{{ $category->type }}">
    @error('type')
    <p class="alert alert-danger">{{ $message}}</p> 
    @enderror
    </div> 

    <input type="submit" class="btn btn-primary" value="update">
</form>
    
@endsection