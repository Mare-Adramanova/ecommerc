<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    {{-- <script src="https://js.stripe.com/v3/"></script> --}}
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css" /> --}}
    
    @yield('stripe-css')
    @yield('extra-css')
    <title>E Commerce</title>
</head>
<body style="font-size: 13px">
    <header>
        @include('/partials/navigation')
    </header>

    <div class="container">
        <div class="row">
            
        
            <div class="col-md-11" id="app">
                @yield('content')
            </div>
        </div>
    </div>

    <footer>
        @include('/partials/footer')
    </footer>

    

    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    
    <script src="{{ asset('js/app.js') }}"></script>
    
</body>
</html>