@extends('admin.layouts.main')
@section('extra-java/script')
<script type="text/javascript">
    jQuery(document).ready(function(){
        let row_number = 1;
        $("#add_row").click(function(e){
          e.preventDefault();
          let new_row_number = row_number - 1;
          $('#product' + row_number).html($('#product' + new_row_number).html()).find('td:first-child');
          $('#products_table').append('<tr id="product' + (row_number + 1) + '"></tr>');
          row_number++;
        });
    
        $("#delete_row").click(function(e){
          e.preventDefault();
          if(row_number > 1){
            $("#product" + (row_number - 1)).html('');
            row_number--;
          }
        });
      });
    </script>
@endsection

@section('content')
    <div class="mt-3 ml-2" >
        <a href="/admin" style="color: black; font-size: 16px; text-decoration: none">Dashboard</a>
        <i class="fa fa-angle-right" style="font-size:24px"></i>
        <span><a href="{{ route('admin.products.index') }}" style="color: black; font-size: 16px; text-decoration: none">Products</a></span>
        <i class="fa fa-angle-right" style="font-size:24px"></i>
        <span><a href="{{ route('admin.products.create') }}" style="color: black; font-size: 16px; text-decoration: none">Create</a></span>
        
    </div>
<form action="{{ route('admin.products.store') }}" method="POST" class="was-validated mt-2 p-2" enctype="multipart/form-data">
    @csrf

    <div class="form-group ml-1">
        <label for="">Product name: </label>
        <input type="text" name="name" placeholder="name:" class="form-control" value="{{ old('name') }}">
        @error('name')
            <p class="alert alert-danger">{{ $message }}</p> 
        @enderror
    </div> 
        
    
    <div class="form-group">
        <label for="">Price: </label>
        <input type="text" name="price" placeholder="price" class="form-control" value="{{ old('price') }}">
        @error('price')
            <p class="alert alert-danger">{{ $message }}</p> 
        @enderror
    </div>

    <div class="form-group">
        <label for="">Description: </label>
        <input type="text" name="description" placeholder="description" class="form-control" value="{{ old('description') }}">
        @error('description')
            <p class="alert alert-danger">{{ $message }}</p> 
        @enderror
    </div>
    

    
    <div class="form-group">
        <label for="exampleFormControlFile1">Upload Image :</label>
        <input name="picture" type="file" class="form-control-file" id="exampleFormControlFile1" value="{{ old('picture') }}">
    </div>
    @error('picture')
        <p class="alert alert-danger">{{ $message }}</p> 
    @enderror
    <hr>
    <div class="form-group">
        <p>Cetegory :</p>
        <ul>
            @foreach ($categories as $category)
            <div class="form-check">
                <li><input type="checkbox" name="type[]" class="form-check-input" id="check" value="{{$category->id}}" multiple>
                <label class="form-check-label" for="check" style="color: black">{{ $category->type }}</label></li>
            </div>
            @endforeach
        </ul>
    </div>
        <div class="form-check ml-4 mb-3">
        <input type="checkbox" name="other" class="form-check-input" id="check4" onclick="show()">
            <label class="form-check-label" for="check4" style="color: black">Add New Categories:</label>
        </div>

        <div class="form-group" id="categories" style="display: none">
            <label for="">Add New Categories: </label>
            <input type="text" name="othertype[]" placeholder="category,category" class="form-control">
            
        </div>
        <hr>
        <div class="form-group">
            <p>Atributes :</p>
            <select name="color_name" id="options">
                <option>color</option>
                    @foreach ($colors as $color)
                    
                        <option value="{{ $color->id }}">{{ $color->name }}</option>
                    @endforeach
            </select>
            <select name="size_name" id=""> 
                <option value="">sizes</option>
                @foreach ($sizes as $size)
                    <option name="option" value="{{ $size->id }}">{{ $size->name }}</option>
                @endforeach
            </select> 
            <input type="text" name="stock" class="ml-2" >
         ///////   
<br>
<div class="card">
    <div class="card-header">
        Products variations
    </div>

    <div class="card-body">
        <table class="table" id="products_table">
            <thead>
                <tr>
                    <th>Color</th>
                    <th>Size</th>
                    <th>Quantity</th>
                </tr>
            </thead>
            <tbody>
                <tr id="product0">
                    <td>
                        <select name="colors[]" class="form-control">
                            <option value="">-- choose color --</option>
                            @foreach ($colors as $color)
                                <option value="{{ $color->id }}">
                                    {{ $color->name }} 
                                </option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                        <select name="sizes[]" class="form-control">
                            <option value="">-- choose size --</option>
                            @foreach ($sizes as $size)
                                <option value="{{ $size->id }}">
                                    {{ $size->name }} 
                                </option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                        <input type="number" name="quantities[]" class="form-control" value="1" />
                    </td>
                </tr>
                <tr id="product1"></tr>
            </tbody>
        </table>

        <div class="row">
            <div class="col-md-12">
                <button id="add_row" class="btn btn-default pull-left">+ Add Row</button>
                <button id='delete_row' class="pull-right btn btn-danger">- Delete Row</button>
            </div>
        </div>
    </div>
</div>
<div>
</div>
            {{-- <ul class="float-left mr-5">
                @foreach ($colors as $color)
                    <div class="form-check">
                        <li><input type="checkbox" name="color_name" class="form-check-input" id="check" value="{{$color->id}}" multiple>
                        <label class="form-check-label" for="check" style="color: black">{{ $color->name }}</label></li>
                    </div> 
                    
                @endforeach
                <ul class="float-left">
                    @foreach ($sizes as $size)
                        <div class="form-check">
                            <li><input type="checkbox" name="size_name" class="form-check-input" id="check" value="{{$size->id}}" multiple>
                            <label class="form-check-label" for="check" style="color: black">{{ $size->name }}</label></li>
                            
                        </div> 
                        
                    @endforeach
                    
                </ul>
                <ul class="ml-5">
                    <li><input type="text" name="stock" class="ml-2" ></li>
                </ul>
            </ul> --}}
            
        </div>


    <input type="submit" class="btn btn-dark mb-5" value="create">

</form>


<script type="text/javascript">
    function show() { document.getElementById('categories').style.display = 'block'; }
    function hide() { document.getElementById('categories').style.display = 'none'; }
</script>

@endsection