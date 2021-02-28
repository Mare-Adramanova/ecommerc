@extends('admin.layouts.main')

@section('content')
<div class="mt-3 ml-2" >
    <a href="/admin" style="color: black; font-size: 16px; text-decoration: none">Dashboard</a>
    <i class="fa fa-angle-right" style="font-size:24px"></i>
    <span><a href="{{ route('admin.categories.index') }}" style="color: black; font-size: 16px; text-decoration: none">Categories</a></span>
    <i class="fa fa-angle-right" style="font-size:24px"></i>
    <span><a href="{{ route('admin.category.show', $category->id) }}" style="color: black; font-size: 16px; text-decoration: none">View</a></span>
    <i class="fa fa-angle-right" style="font-size:24px"></i>
    <span>{{ $category->type }}</span>
</div>

<div class="table-responsive-sm p-2">
    <table class="table table-sm table-hover">
        <thead>
            <th style="width: 10%">id</th>
            <th style="width: 30%">type</th>
            <th style="width: 25%">created at</th>
            <th style="width: 25%">updated at</th>
           
        </thead>
        <tbody>
                
            <tr>
                <td>{{  $category->id }}</td>
                <td>{{  $category->type }}</td>
                <td>{{  $category->created_at }}</td>
                <td>{{  $category->updated_at }}</td>
                        
            </tr>
                
                    
        </tbody>
        
    </table>
</div>
    
@endsection