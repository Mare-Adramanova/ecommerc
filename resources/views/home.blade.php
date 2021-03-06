{{-- @extends('layouts.app') --}}
@extends('layouts.main')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="mt-3 ml-2" >
                <a href="/" style="color: black; font-size: 16px; text-decoration: none">Home</a>
                <i class="fa fa-angle-right" style="font-size:24px"></i>
                <span><a href="{{ url('/home') }}" style="color: black; font-size: 16px; text-decoration: none">My profile</a></span>
            </div>
            <hr>
            <div class="container row">
                <div class="sidebar float-left col-md-3" id="sidebar">

                    <ul class="list-group list-group-flush">
                      <li class="list-group-item"><a href="{{ url('/home') }}" class="text-dark stretched-link" >My Profile</a></li>
                      <li class="list-group-item"><a href="{{ route('orders.index') }}">My Orders</a></li>
                    </ul>
                </div> 
                <div class="my-profile col-md-7">
                    <div>
                        <h2>My Profile</h2>
                    </div>
                    <div>
                        <form action="{{ route('users.update') }}" method="POST">
                            @method('put')
                            @csrf
                            
                                <div class="form-group">
                                    <input class="form-control" id="name" type="text" name="name" value="{{ old('name', $user->name) }}" placeholder="Name" required>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" id="email" type="email" name="email" value="{{ old('email', $user->email) }}" placeholder="Email" required>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" id="password" type="password" name="password" placeholder="Password">
                                    <div>Leave password blank to keep current password</div>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" id="password-confirm" type="password" name="password_confirmation" placeholder="Confirm Password">
                                </div>
                               
                            <div>
                                <button type="submit" class="btn btn-dark">Update Profile</button>
                            </div>
                        
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
<style type="text/css">
#sidebar ul li a{
    
    color: black !important;
    
    
  }
#sidebar ul li a:hover{
    background-color: white !important;
    color: black !important;
    
  }

</style>
