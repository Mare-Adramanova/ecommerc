@extends('admin.layouts.main')

@section('content')
<div class="mt-3 ml-2" >
    <a href="/admin" style="color: black; font-size: 16px; text-decoration: none">Dashboard</a>
    <i class="fa fa-angle-right" style="font-size:24px"></i>
    <span><a href="{{ route('admin.categories.index') }}" style="color: black; font-size: 16px; text-decoration: none">Categories</a></span>
    <a href="{{ route('admin.categories.create') }}" class="btn btn-success ml-3 mb-3">+ add new</a>
</div>
<div class="table-responsive-sm p-2">
    <table class="table table-sm table-hover">
        <thead>
            <th style="width: 10%">id</th>
            <th style="width: 60%">type</th>
            <th style="width: 10%">view</th>
            <th style="width: 10%">edit</th>
            <th style="width: 10%">delete</th>
        </thead>
        <tbody>
                @foreach ($categories as $category)
                    <tr>
                        <td>{{  $category->id }}</td>
                        <td>{{  $category->type }}</td>
                        <td><a href="{{ route('admin.category.show', $category->id) }}" class="btn btn-warning">view</a></td>
                        <td><a href="{{ route('admin.category.edit', $category->id) }}" class="btn btn-primary">edit</a></td>
                        <td>
                            <form action="{{ route('admin.category.destroy', $category->id) }}" method="POST">
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