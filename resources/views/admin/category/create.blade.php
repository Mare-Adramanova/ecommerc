@extends('admin.layouts.main')

@section('content')
<div class="mt-3 ml-2" >
    <a href="/admin" style="color: black; font-size: 16px; text-decoration: none">Dashboard</a>
    <i class="fa fa-angle-right" style="font-size:24px"></i>
    <span><a href="{{ route('admin.categories.index') }}" style="color: black; font-size: 16px; text-decoration: none">Categories</a></span>
    <i class="fa fa-angle-right" style="font-size:24px"></i>
    <span><a href="{{ route('admin.categories.create') }}" style="color: black; font-size: 16px; text-decoration: none">Create</a></span>
    
</div>

    <form action="{{ route('admin.categories.store') }}" method="POST" class="was-validated mt-2 p-2">
        @csrf
        <div class="form-group ml-1">
            <label for="">Type: </label>
            <input type="text" name="type" placeholder="type:" class="form-control" value="{{ old('type') }}">
            @error('type')
                <p class="alert alert-danger">{{ $message }}</p> 
            @enderror
        </div> 

        <input type="submit" class="btn btn-dark mb-5" value="create">

    </form>
    
@endsection