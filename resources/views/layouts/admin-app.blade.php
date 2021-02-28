<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ECommerce</title>
</head>
<body>
    <div class="container">
        
                @yield('content')
           
    </div>

    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    
    <script src="{{ asset('js/app.js') }}"></script>
    
</body>
</html>