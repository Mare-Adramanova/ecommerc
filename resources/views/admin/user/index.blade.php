@extends('admin.layouts.main')

@section('content')
<div class="mt-3 ml-2" >
    <a href="/admin" style="color: black; font-size: 16px; text-decoration: none">Dashboard</a>
    <i class="fa fa-angle-right" style="font-size:24px"></i>
    <span><a href="{{ route('admin.users.index') }}" style="color: black; font-size: 16px; text-decoration: none">users</a></span>
    <a href="{{ route('admin.users.create') }}" class="btn btn-success ml-3 mb-3">add new</a>
</div>
 
<div class="table-responsive-sm p-2">
<table class="table table-sm table-hover">
    <thead>
        <th> Id </th>
        <th> Name</th>
        <th>email</th>
        <th>View</th>
        <th>Edite</th>
        <th>Delete</th>
    </thead>
    <tbody>
        
            @foreach ($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    
                    <td><a href="{{ route('admin.user.show', $user->id) }}" class="btn btn-warning">view</a></td>
                    <td><a href="" class="btn btn-primary">edit</a></td>
                    <td>
                        <form action="{{ route('admin.user.destroy', $user->id) }}" method="POST">
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
    {!! $users->links() !!}
</div> 
@endsection
