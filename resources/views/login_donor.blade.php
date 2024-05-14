<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        .header-color{
            background-color: #B61A20; 
        }
        .donor-custom-color{
            background-color: #B61A20; 
        }
        .admin-custom-color{
            background-color: whitesmoke;
        }
        a{
            text-decoration: none;
        }
        .login-custom-btn{
            background-color: #B61A20;
            color: white;
            width: 50%;
        }
        .login-custom-btn:hover{
            background-color: rgb(237, 24, 24);
            color: white;
            
        }
    </style>
    </head>
  <body>
    <header class="header header-color p-3">
        <div class="container">
            <img src="{{asset('images/red-cross-logo.png')}}" alt="Logo" height="90">
            <span class="ms-2 fs-5 fw-bold text-white">Blood Donation System - Red Cross Pangasinan</span>
        </div>
    </header>
    <br>
    <div class="container">
        <div class="card border-0 shadow p-4">
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <div class="card donor-custom-color border-0 shadow text-white">
                            <div class="card-body d-flex justify-content-center align-items-center">
                                <h5 class="card-title text-center">Donor</h5>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <a href="{{ route('login_admin') }}">
                            <div class="card admin-custom-color border-0 shadow text-dark">
                                <div class="card-body d-flex justify-content-center align-items-center">
                                    <h5 class="card-title text-center">Admin</h5>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                <hr><br>
                {{-- Dito Login Form --}}
                <div class="text-center">
                    <h3 class="fw-bold">Donor Login Form</h3>
                </div>
                <div class="card border-0" style="max-width: 500px; margin: 0 auto;">
                    <div class="card-body">
                        @if ($errors->has('error'))
                            <p class="fw-bold fs-5 text-danger">{{ $errors->first('error') }}</p>
                            <br><br>
                        @endif
                        <form action="{{ route('login') }}" method="post">
                            @csrf
                            <label for="username" class="fw-bold">Username: </label>
                            <input type="text" name="username" class="form-control" required>
                            <br>
                            <label for="password" class="fw-bold">Password: </label>
                            <input type="password" name="password" class="form-control" required>
                            <br><br>
                            <div class="text-center">
                                <input type="submit" class="btn login-custom-btn" value="LOGIN">  
                            </div>
                        </form>
                    </div>
                </div>                
            </div>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>