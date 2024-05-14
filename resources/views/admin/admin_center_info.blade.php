<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Center Information</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <script src="{{asset('js/jquery-3.3.1.js')}}"></script>
    <style>
        .header-color{
            background-color: #B61A20; 
        }
        .custom-color-side-bar{
            background-color: whitesmoke; 
            border: 1px white solid;
        }
        .edit-btn-custom{
            background-color: #B61A20;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .edit-btn-custom:hover{
            background-color: red;
        }
    </style>
    </head>
  <body>
    {{-- <h1>{{session('admin')}}</h1>
    <h1>{{$admin->name}}</h1> --}}

    @if(session()->has('admin'))
    {{-- Dito Header --}}
    <header class="header header-color p-1 d-flex justify-content-between align-items-center p-3">
        <div>
            <img src="{{ asset('images/red-cross-logo.png') }}" alt="Logo" height="50">
            <span class="ms-2 fw-bold text-white">Blood Donation System - Red Cross Pangasinan</span>
        </div>
        <div>
            <a href="{{ route('logout_admin') }}" class="btn btn-outline-light">Logout</a>
        </div>
    </header>

    {{-- Dito Sidebar and content --}}
    <div class="container-fluid">
        <div class="row flex-nowrap">
            <div class="col-auto col-md-3 col-xl-2 px-sm-2 px-0 custom-color-side-bar shadow">
                <div class="d-flex flex-column align-items-center align-items-sm-start px-3 pt-2 text-white min-vh-100">
                    <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start" id="menu">
                        <li class="nav-item">
                            <a href="{{url('/home_admin')}}" class="nav-link align-middle px-0 ">
                                <i class="fs-4 bi-house"></i> <span class="ms-1 d-none d-sm-inline">Home</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('dashboard_admin') }}" class="nav-link px-0 align-middle ">
                                <i class="fs-4 bi-speedometer2"></i> <span class="ms-1 d-none d-sm-inline">Donor List</span> </a>
                        </li>
                        <li>
                            <a href="#" class="nav-link px-0 align-middle text-danger fw-bold fs-4">
                                <i class="fs-4 bi-info-circle"></i> <span class="ms-1 d-none d-sm-inline">Center Information</span></a>
                        </li>
                        <li>
                            <a href="{{ route('blood_donation_drive_admin') }}" class="nav-link px-0 align-middle ">
                                <i class="fs-4 bi-droplet"></i> <span class="ms-1 d-none d-sm-inline">Blood Donation Drive</span></a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col py-3">
                {{-- <h1>{{session('admin')}}</h1>
                <h1>{{$center->center_name}}</h1>
                <h1>{{$center->id}}</h1>

                @foreach ($schedules as $schedule)
                    <p>{{$schedule->day}} {{$schedule->start_time}} {{$schedule->end_time}}</p>
                @endforeach --}}

                <div class="card border-0 shadow">
                    <div class="card-body">
                        <h2 class="fw-bold">Blood Center Information</h2>
                        <hr><br>
                        <div class="row">
                            <div class="col">
                                <div class="card border-0 shadow">
                                    <div class="card-body">
                                        <div class="text-center">
                                            <h5>Information</h5><hr><br>
                                        </div>
                                        <p>Center name: <span class="fw-bold">{{$center->center_name}}</span></p>
                                        <p>Address: <span class="fw-bold">{{$center->street}}, {{$center->barangay}}, {{$center->town}}</span></p>
                                    </div>
                                </div>
                                <button class="btn edit-btn-custom mt-3 fw-bold text-white fs-5" style="width: 100%;" onclick="openEditForm()">Edit</button>
                            </div>
                            <div class="col">
                                <div class="card border-0 shadow">
                                    <div class="card-body">
                                        <div class="text-center">
                                            <h5>Schedule</h5><hr>
                                        </div>
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>Day</th>
                                                    <th>Starting Time</th>
                                                    <th>Ending Time</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($schedules as $schedule)
                                                    <tr>
                                                        <td>{{$schedule->day}}</td>
                                                        <td>{{$schedule->start_time}}</td>
                                                        <td>{{$schedule->end_time}}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br>
                        
                        @if(isset($success))
                            <div class="alert alert-success">
                                {{ $success }}
                            </div>
                        @endif


                        <div id="edit-form" class="card border-0 shadow p-2">
                            <div class="card-body">
                                <h5>Edit Form</h5>
                                <hr>
                                        <form action="{{ route('editCenterSched', session('admin')) }}" method="POST">
                                            @csrf
                                            <label for="center_name" class="fw-bold">Center name: </label>
                                            <input type="text" name="center_name" class="form-control" value="{{$center->center_name}}">
                                            <div class="row">
                                                <div class="col">
                                                    <label for="street" class="fw-bold">Street: </label>
                                                    <input type="text" name="street" class="form-control" value="{{$center->street}}">
                                                </div>
                                                <div class="col">
                                                    <label for="barangay" class="fw-bold">Barangay: </label>
                                                    <input type="text" name="barangay" class="form-control" value="{{$center->barangay}}">
                                                </div>
                                                <div class="col">
                                                    <label for="town" class="fw-bold">Town: </label>
                                                    <input type="text" name="town" class="form-control" value="{{$center->town}}">
                                                </div>
                                            </div>
                                            <br><hr>
                                            @foreach ($schedules as $index => $schedule)
                                                <div class="row">
                                                    <div class="col">
                                                        <label for="day_{{$index}}" class="fw-bold">Day: </label>
                                                        <input type="text" name="day_{{$index}}" class="form-control" value="{{$schedule->day}}">
                                                    </div>
                                                    <div class="col">
                                                        <label for="start_time_{{$index}}" class="fw-bold">Starting time: </label>
                                                        <input type="time" name="start_time_{{$index}}" class="form-control" value="{{$schedule->start_time}}">
                                                    </div>
                                                    <div class="col">
                                                        <label for="end_time_{{$index}}" class="fw-bold">Ending time: </label>
                                                        <input type="time" name="end_time_{{$index}}" class="form-control" value="{{$schedule->end_time}}">
                                                    </div>
                                                </div>
                                            @endforeach
                                            <br><br>
                                            <div class="text-center">
                                                <input type="submit" class="btn edit-btn-custom text-white fw-bold fs-5" value="Edit" style="width: 50%;">
                                            </div>
                                        </form>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>


    @else
    <p>User not logged in.</p>
    <a href="{{route('login_donor')}}">Login Here</a>

    @endif

    <script>
         $(document).ready(function () {
            $('#edit-form').hide();

        })
        function openEditForm(){
            $('#edit-form').show();
        }
    </script>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    </body>
</html>