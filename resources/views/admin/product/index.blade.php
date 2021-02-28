@extends('admin.layouts.main')

@section('content')
<div class="mt-3 ml-2" >
    <a href="/admin" style="color: black; font-size: 16px; text-decoration: none">Dashboard</a>
    <i class="fa fa-angle-right" style="font-size:24px"></i>
    <span><a href="{{ route('admin.products.index') }}" style="color: black; font-size: 16px; text-decoration: none">Products</a></span>
    <a href="{{ route('admin.products.create') }}" class="btn btn-success ml-3 mb-3">add new</a>
</div>
 
<div class="table-responsive-sm p-2">
<table class="table table-sm table-hover">
    <thead>
        <th> Id </th>
        <th>Picture</th>
        <th> Name</th>
        <th>Price</th>
        <th>Description</th>
        <th>Categories</th>
        <th>View</th>
        <th>Edite</th>
        <th>Delete</th>
    </thead>
    <tbody>
        
            @foreach ($products as $product)
                <tr>
                    <td>{{ $product->id }}</td>
                    <td><img src="{{ asset('storage/public/'.$product->picture) }}" alt="" style="width: 100px"> </td>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->presentPrice() }}</td>
                    <td>{{ $product->description }}</td>
                    @if (count($product->categories) < 1)
                    <td>no related categories</td>
                    
                    @else
                    <td>
                    @foreach ($product->categories as $category)
                    {{ $category->type }} <br>
                    @endforeach 
                    </td>
                    @endif
                    
                    <td><a href="{{ route('admin.product.show', $product->id) }}" class="btn btn-warning">view</a></td>
                    <td><a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-primary">edit</a></td>
                    <td>
                        <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST">
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
<div class="d-flex justify-content-center">
    {!! $products->links() !!}
</div> 
@endsection
