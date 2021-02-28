@extends('layouts.main')

@section('content')

    <table class="table table-dark m-3">
            <thead>
                <th></th>
                <th></th>
                <th>Your Searching Result</th>
                <th></th>
                <th></th>
            </thead>
            @foreach ($products as $product)
                <tr style="color: red">
                    <td ><a href="{{ route('products.show', $product->id) }}">
                            <img src="{{ asset('storage/public/'.$product->picture) }}" alt="" class="float-left" style="width: 250px"></td>
                        </a>
                    <td colspan="2" class="pt-5"><h3><a href="{{ route('products.show', $product->id) }}">{{ $product->name }}</a></h3><br>
                                                 <p>{{ $product->description }}</p>
                    </td>
                    
                </tr>    
            @endforeach
            
        
    </table>
        

   

@endsection
{{-- <script type="text/javascript"> --}}
{{-- var path= "{{ route('autocomplite') }}"; --}}
{{-- $('input.typeahead').typeahead({ --}}
    {{-- source:function(terms,proces){ --}}
        {{-- return $.get(path{terms:terms},function(data){ --}}
            {{-- return process(data); --}}
        {{-- } ) --}}
    {{-- } --}}
{{-- }) --}}

{{-- </script> --}}