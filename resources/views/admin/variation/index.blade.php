@extends('admin.layouts.main')

@section('content')
<div class="mt-3 ml-2" >
    <a href="/admin" style="color: black; font-size: 16px; text-decoration: none">Dashboard</a>
    <i class="fa fa-angle-right" style="font-size:24px"></i>
    <span><a href="{{ route('admin.productVariations.index') }}" style="color: black; font-size: 16px; text-decoration: none">Product Variations</a></span>
    <a href="{{ route('admin.productVariations.create') }}" class="btn btn-success ml-3 mb-3">add new</a>
</div>
 
<div class="table-responsive-sm p-2">
<table class="table table-sm table-hover">
    <thead>
        <th>Product Id </th>
        <th>Color Id</th>
        <th>Size Id</th>
        <th>Quantity</th>
        <th>View</th>
        <th>Edite</th>
        <th>Delete</th>
    </thead>
    <tbody>
        
            @foreach ($variations as $variation)
                <tr>
                    <td>{{ $variation->product_id }}</td>
                    <td>{{ $variation->color_id }}</td>
                    <td>{{ $variation->size_id }}</td>
                    <td>{{ $variation->quantity }}</td>
                    <td><a href="{{ route('admin.productVariations.show', $variation->id) }}" class="btn btn-warning">view</a></td>
                    <td><a href="{{ route('admin.productVariations.edit', $variation->id) }}" class="btn btn-primary">edit</a></td>
                    <td>
                        <form action="{{ route('admin.productVariations.destroy', $variation->id) }}" method="POST">
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
    {!! $variations->links() !!}
</div> 
@endsection