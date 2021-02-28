@extends('admin.layouts.main')

@section('content')
<div class="mt-3 ml-2" >
    <a href="/admin" style="color: black; font-size: 16px; text-decoration: none">Dashboard</a>
    <i class="fa fa-angle-right" style="font-size:24px"></i>
    <span><a href="{{ route('admin.colors.index') }}" style="color: black; font-size: 16px; text-decoration: none">Colors</a></span>
    <i class="fa fa-angle-right" style="font-size:24px"></i>
    <span><a href="{{ route('admin.color.show', $color->id) }}" style="color: black; font-size: 16px; text-decoration: none">View</a></span>
    <i class="fa fa-angle-right" style="font-size:24px"></i>
    <span>{{ $color->name }}</span>
</div>

<div class="table-responsive-sm p-2">
    <table class="table table-sm table-hover">
        <thead>
            <th style="width: 10%">id</th>
            <th style="width: 30%">name</th>
            <th style="width: 20%">hex color</th>
            <th style="width: 20%">created at</th>
            <th style="width: 20%">updated at</th>
           
        </thead>
        <tbody>
                
            <tr>
                <td>{{  $color->id }}</td>
                <td>{{  $color->name }}</td>
                <td style="background: {{ $color->hex_color }}"></td>
                <td>{{  $color->created_at }}</td>
                <td>{{  $color->updated_at }}</td>
                        
            </tr>
                
                    
        </tbody>
        
    </table>
</div>
    
@endsection