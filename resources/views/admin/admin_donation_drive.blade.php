<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Blood Donation Drive</title>
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
                            <a href="{{ route('center_information_admin') }}" class="nav-link px-0 align-middle ">
                                <i class="fs-4 bi-info-circle"></i> <span class="ms-1 d-none d-sm-inline">Center Information</span></a>
                        </li>
                        <li>
                            <a href="#" class="nav-link px-0 align-middle text-danger fw-bold fs-4">
                                <i class="fs-4 bi-droplet"></i> <span class="ms-1 d-none d-sm-inline">Blood Donation Drive</span></a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col py-3">
                {{-- Content here --}}
                <div class="card border-0 shadow">
                    <div class="card-body">
                        <h2 class="fw-bold">Blood Donation Drive</h2>
                        <hr><br>
                        <button class="btn btn-danger mb-3" onclick="openAddForm()">
                            <i class="bi bi-plus"></i> Add new
                        </button>
                        <div id="add-form" class="card border-0 shadow">
                            <div class="card-body">
                                <h5>Add new Blood Donation Drive</h5><hr><br>
        
                                <form action="{{ route('addNewBloodDonationDrive') }}" method="post">
                                    @csrf
                                    <div class="row">
                                        <div class="col">
                                            <label for="establishment_name" class="fw-bold">Establishment name:</label>
                                            <input type="text" name="establishment_name" class="form-control" required placeholder="Establishment Name">
                                        </div>
                                        <div class="col">
                                            <label for="date" class="fw-bold">Date: </label>
                                            <input type="date" name="date" class="form-control" required>
                                        </div>
                                    </div><br>
                                        <label for="address" class="fw-bold">Address: </label>
                                        <input type="text" name="address" class="form-control" required placeholder="Address">
                                    <br>
                                    <div class="row">
                                        <div class="col">
                                            <label for="start_time" class="fw-bold">Starting time: </label>
                                            <input type="time" name="start_time" class="form-control" required>
                                        </div>
                                        <div class="col">
                                            <label for="end_time" class="fw-bold">Ending time: </label>
                                            <input type="time" name="end_time" class="form-control" required>
                                        </div>
                                        <div class="col">
                                            <label for="phone" class="fw-bold">Phone: </label>
                                            <input type="text" name="phone" class="form-control" required placeholder="Phone">
                                        </div>
                                    </div>
                                    <br><br>
                                    <div class="text-center">
                                        <input type="submit" class="btn btn-danger" style="width: 50%">
                                    </div>
                                    <br>
                                </form>
                            </div>
                        </div><br>
                        @if(isset($success))
                            <div class="alert alert-success">
                                {{ $success }}
                            </div>
                        @endif

                        @if(isset($error))
                            <div class="alert alert-danger">
                                {{ $error }}
                            </div>
                        @endif
                        <br>
                        <div class="card border-0 shadow">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th>Establishment Name</th>
                                                <th>Address</th>
                                                <th>Date</th>
                                                <th>Starting time</th>
                                                <th>Ending time</th>
                                                <th>Contact Information</th>
                                                <th>Status</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if ($donationDrives->isEmpty())
                                                <tr>
                                                    <td colspan="8" class="text-center">No Records Yet.</td>
                                                </tr>
                                            @else
                                                @foreach ($donationDrives as $donationDrive)
                                                    <tr>
                                                        <td>{{ $donationDrive->establishment_name }}</td>
                                                        <td>{{ $donationDrive->address }}</td>
                                                        <td>{{ $donationDrive->date }}</td>
                                                        <td>{{ $donationDrive->start_time }}</td>
                                                        <td>{{ $donationDrive->end_time }}</td>
                                                        <td>{{ $donationDrive->phone }}</td>
                                                        <td>{{ $donationDrive->status == 1 ? "Done" : "Not Done" }}</td>
                                                        <td>
                                                            <div class="btn-group" role="group">
                                                                <a href="{{ route('editStatus', $donationDrive->id) }}" class="btn btn-success">Status</a>
                                                                <a href="{{ route('deleteDonationDrive', $donationDrive->id) }}" class="btn btn-danger">Delete</a>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @endif

                                        </tbody>
                                    </table>
                                </div>
                                
                                <br>
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
            $('#add-form').hide();

        })
        function openAddForm(){
            $('#add-form').show();
        }
    </script>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    </body>
</html>