@extends('admin.layouts.main')

@section('content')
<div class="mt-3 ml-2" >
    <a href="/admin" style="color: black; font-size: 16px; text-decoration: none">Dashboard</a>
    <i class="fa fa-angle-right" style="font-size:24px"></i>
    <span><a href="{{ route('admin.colors.index') }}" style="color: black; font-size: 16px; text-decoration: none">Colors</a></span>
    <a href="{{ route('admin.colors.create') }}" class="btn btn-success ml-3 mb-3">+ add new</a>
</div>
<div class="table-responsive-sm p-2">
    <table class="table table-sm table-hover">
        <thead>
            <th style="width: 10%">id</th>
            <th style="width: 30%">name</th>
            <th style="width: 30%">hex code</th>
            <th style="width: 6%">view</th>
            <th style="width: 6%">edit</th>
            <th style="width: 6%">delete</th>
        </thead>
        <tbody>
                @foreach ($colors as $color)
                    <tr>
                        <td>{{  $color->id }}</td>
                        <td>{{  $color->name }}</td>
                        <td style="background: {{$color->hex_color}}"></td>
                        <td><a href="{{ route('admin.color.show', $color->id) }}" class="btn btn-warning">view</a></td>
                        <td><a href="{{ route('admin.color.edit', $color->id) }}" class="btn btn-primary">edit</a></td>
                        <td>
                            <form action="{{ route('admin.color.destroy', $color->id) }}" method="POST">
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