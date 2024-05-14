<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        .header-color{
            background-color: #B61A20; 
        }
        .custom-color-side-bar{
            background-color: whitesmoke; 
        }
        h3{
          color: #B61A20;
        }
    </style>
    </head>
  <body>
    {{-- <h1>{{session('admin')}}</h1>
    <h1>{{$admin->name}}</h1> --}}

    @if(session()->has('admin'))
    @include('admin.admin_header')
    @include('admin.admin_sidebar_main')

    @else
    <p>User not logged in.</p>
    <a href="{{route('login_donor')}}">Login Here</a>

    @endif
    

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>