@extends('layouts.main')

@section('content')

@auth
    <div class="card-text">
        <form class="form-group" action="" method="POST">
            @csrf
            <label> Comment</label>
            <div class="row">

                <textarea class="form-control col-md-7 mx-4" name="text" id="" ></textarea>
            
                <input type="submit" class="btn btn-primary col-md-2 ">
                
                <input type="color" name="color" id="color" class="col-md-1" value="#f0ad4e">

            </div>
            
            
        </form>
    </div> 

    
@endauth

    
@endsection
  {{-- action="{{ route('comments.store', ['post_id'=>$post->id]) }}" --}}