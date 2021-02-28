@extends('admin.layouts.main')

@section('content')
<div class="mt-3 ml-2" >
    <a href="/admin" style="color: black; font-size: 16px; text-decoration: none">Dashboard</a>
    <i class="fa fa-angle-right" style="font-size:24px"></i>
    <span><a href="{{ route('admin.colors.index') }}" style="color: black; font-size: 16px; text-decoration: none">Colors</a></span>
    <i class="fa fa-angle-right" style="font-size:24px"></i>
    <span><a href="{{ route('admin.colors.create') }}" style="color: black; font-size: 16px; text-decoration: none">Create</a></span>
    
</div>

    <form action="{{ route('admin.colors.store') }}" method="POST" class="was-validated mt-2 p-2">
        @csrf
        <div class="form-group ml-1">
            <label for="">Name: </label>
            <input type="text" name="name" placeholder="value:" class="form-control" value="{{ old('name') }}">
            @error('name')
                <p class="alert alert-danger">{{ $message }}</p> 
            @enderror
        </div> 
        <div class="form-group ml-1">
            <label for="">Hex_color: </label>
            <input type="text" name="hex_color" placeholder="value:" class="form-control" value="{{ old('hex_color') }}">
            @error('hex_color')
                <p class="alert alert-danger">{{ $message }}</p> 
            @enderror
        </div> 

        <input type="submit" class="btn btn-dark mb-5" value="create">

    </form>
    
@endsection