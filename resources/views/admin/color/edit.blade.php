@extends('admin.layouts.main')

@section('content')
<div class="mt-3 ml-2" >
    <a href="/admin" style="color: black; font-size: 16px; text-decoration: none">Dashboard</a>
    <i class="fa fa-angle-right" style="font-size:24px"></i>
    <span><a href="{{ route('admin.colors.index') }}" style="color: black; font-size: 16px; text-decoration: none">Colors</a></span>
    <i class="fa fa-angle-right" style="font-size:24px"></i>
    <span><a href="{{ route('admin.color.edit', $color->id) }}" style="color: black; font-size: 16px; text-decoration: none">Edit</a></span>
    
</div>
<form action="{{ route('admin.color.update', $color->id) }}" method="POST" class="was-validated m-3">
    @csrf
    @method('PUT')

    <div class="form-group">
        <label for="">Color name: </label>
        <input type="text" name="name" placeholder="name:" class="form-control" value="{{ $color->name }}">
        @error('name')
        <p class="alert alert-danger">{{ $message}}</p> 
        @enderror
    </div> 
    <div class="form-group">
        <label for="">Color name: </label>
        <input type="text" name="hex_color" placeholder="hex_color:" class="form-control" value="{{ $color->hex_color }}">
        @error('hex_color')
        <p class="alert alert-danger">{{ $message}}</p> 
        @enderror
    </div> 


    <input type="submit" class="btn btn-primary" value="update">
</form>
    
@endsection