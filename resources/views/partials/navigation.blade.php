
<nav class="navbar navbar-expand-sm bg-primary border-bottom border-danger text-white navbar-primary" style="border-bottom-width: 8px !important">
    
    <a class="navbar-brand" href="#">
      <img src="https://cdn.pixabay.com/photo/2016/12/07/15/15/lotus-with-hands-1889661__340.png" alt="logo" style="width:50px;">
    </a>
    

    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link font-weight-bold" href="/products">HOME</a>
      </li>
      <li class="nav-item">
        <a class="nav-link font-weight-bold" href="/shop">SHOP</a>
      </li>
      <li class="nav-item font-weight-bold">
        <a class="nav-link" href="#">ABOUT</a>
      </li>
    </ul>

    <div class="col-md-5 mb-4">

    </div>

    <div>
      <form action="{{ route('search.index') }}" method="POST">
        @csrf
        <div class="input-group">
          <input type="text" name="name" class="form-control" placeholder="Search this blog">
          <div class="input-group-append">
            <button class="btn btn-secondary" type="submit" value="Search this page">
              <i class="fa fa-search mt-1"></i>
            </button>
            
          </div>
        </div>

      </form>

    </div>
    <div class="dropdown ml-2 mr-2">
     @auth
         
     
    <i class="fa fa-bell ml-3" aria-hidden="true" data-toggle="dropdown" style="color: black; font-size:20px"></i> 
      @if (count(auth()->user()->unreadNotifications) === 0 )
        <span class="badge badge-notify" style="display: none"></span>
        <ul class="dropdown-menu" style="color: black; width: 300px">
          <h4><b>Notifications:</b></h4>
          <li class="ml-3 mt-2 mb-2">
            
            <b> {{ "You don't have unread notification at this time!" }}</b>
            
          </li>
         
        </ul>
      @else
        <span class="badge badge-notify">{{ count(auth()->user()->unreadNotifications) }}</span>
        <ul class="dropdown-menu" style="color: black; width: 350px">
          <h4><b>Notifications:</b></h4>
          <li class="ml-3 mt-2 mb-2">
            @foreach (auth()->user()->unreadNotifications as $notification)
              @if ($notification->type === "App\Notifications\PaymentReceived" )
              <a href="#" style="color: black; background-color: white; text-decoration: none"><b>We have received a payment from you.</b></a>
                  
              @endif
             {{$notification->markAsRead()}}
            @endforeach
            
          </li>
         
        </ul>
      @endif
      
      
      @endauth 
    </div>
    <div class="cart"><a href="/cart" class="text-dark ml-2"><i class="fa fa-cart-plus text-dark"></i> Cart {{ count((array) session('cart')) }}</a> </div>
    @auth   
      <div class="wish_list"><a href="/wish_list" class="text-dark ml-3"><i class="fa fa-heart-o" style="font-size:28px;color:red; position: relative;">
        
      </i><span class="mr-5" style="position:absolute; right: 216px; top:36px;color:red;">{{ count((array) session('wish_list')) }}</span></a> </div>
   @endauth  
   @guest
      <div class="wish_list"><a href="/wish_list" class="text-dark ml-3"><i class="fa fa-heart-o" style="font-size:28px;color:red; position: relative;">
        
      </i><span class="mr-5" style="position:absolute; right: 268px; top:33px;color:red;">{{ count((array) session('wish_list')) }}</span></a> </div>  
    @endguest
    @if (Route::has('login'))
       <div class="fixed ml-3 top-0 right-3 px-6 py-4 sm:block">
          @auth
            @if (Route::has('login') && Route::currentRouteName() != 'home')
              <a href="{{ url('/home') }}" class="text-sm text-dark underline">My Profile</a>

            @else
              <a href="{{ url('/home') }}" class="text-sm text-dark underline" style="display: none">My Profile</a>
              <ul class="navbar-nav ml-auto"> 
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                       {{ Auth::user()->name }}
                    </a>

                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                      <a class="dropdown-item" href="{{ route('logout') }}"
                         onclick="event.preventDefault();
                           document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                      </a>

                      <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                      </form>
                    </div>
                </li>
              </ul> 
                       
            @endif 
  
            @else
                <a href="{{ route('login') }}" class="text-sm text-dark underline">Login</a>

                  @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="ml-4 text-sm text-dark underline">Register</a>
                  @endif
            @endif
                     
        </div>

    @endif
  </nav>
  

  <style type="text/css">
  ul li a{
    
    color: red;
    
    
  }
  ul li a:hover{
    background-color:red;
    color: white;
    
  }
  .badge-notify{
   background:red;
   position:relative;
   transform: translate(-100%, -100%);
}

  </style>