<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Donor List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="//cdn.datatables.net/2.0.7/css/dataTables.dataTables.min.css">
    <script src="{{ asset('js/jquery-3.3.1.js') }}"></script>
    <style>
        .header-color {
            background-color: #B61A20; 
        }
        .custom-color-side-bar {
            background-color: whitesmoke; 
            border: 1px white solid;
        }
    </style>
  </head>
  <body>
    @if(session()->has('admin'))
    <header class="header header-color p-1 d-flex justify-content-between align-items-center p-3">
        <div>
            <img src="{{ asset('images/red-cross-logo.png') }}" alt="Logo" height="50">
            <span class="ms-2 fw-bold text-white">Blood Donation System - Red Cross Pangasinan</span>
        </div>
        <div>
            <a href="{{ route('logout_admin') }}" class="btn btn-outline-light">Logout</a>
        </div>
    </header>

    <div class="container-fluid">
        <div class="row flex-nowrap">
            <div class="col-auto col-md-3 col-xl-2 px-sm-2 px-0 custom-color-side-bar shadow">
                <div class="d-flex flex-column align-items-center align-items-sm-start px-3 pt-2 text-white min-vh-100">
                    <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start" id="menu">
                        <li class="nav-item">
                            <a href="{{ url('/home_admin') }}" class="nav-link align-middle px-0">
                                <i class="fs-4 bi-house"></i> <span class="ms-1 d-none d-sm-inline">Home</span>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="nav-link px-0 align-middle text-danger fw-bold fs-4">
                                <i class="fs-4 bi-speedometer2"></i> <span class="ms-1 d-none d-sm-inline">Donor List</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('center_information_admin') }}" class="nav-link px-0 align-middle">
                                <i class="fs-4 bi-info-circle"></i> <span class="ms-1 d-none d-sm-inline">Center Information</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('blood_donation_drive_admin') }}" class="nav-link px-0 align-middle">
                                <i class="fs-4 bi-droplet"></i> <span class="ms-1 d-none d-sm-inline">Blood Donation Drive</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col py-3">

                <div class="card border-0 shadow p-2" style="width: auto;">
                    <div class="card-body">
                        <h2 class="fw-bold">Donor List</h2>
                        <br><br>
                        <div class="card border-0 shadow">
                            <div class="card-body">
                                <h5>Schedule Today</h5><hr>
                                @if(session('success'))
                                    <div class="alert alert-success">
                                        {{ session('success') }}
                                    </div>
                                @endif
                                <div class="table-responsive">
                                    <table id="donor-table" class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th>Id</th>
                                                <th>Name</th>
                                                <th>Gender</th>
                                                <th>Blood Type</th>
                                                <th>Allergies</th>
                                                <th>Medical History</th>
                                                <th>Date</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($current_donors as $current_donor)
                                                <tr>
                                                    <td>{{$current_donor->donor->id}}</td>
                                                    <td>{{ $current_donor->donor->fname }} {{ $current_donor->donor->mname }} {{ $current_donor->donor->lname }}</td>
                                                    <td>
                                                        @if ($current_donor->donor->gender == 'male')
                                                            Male
                                                        @elseif($current_donor->donor->gender == 'female')
                                                            Female
                                                        @else
                                                            Other
                                                        @endif
                                                    </td>
                                                    <td>{{ $current_donor->donor->blood_type }}</td>
                                                    <td>{{ $current_donor->donor->allergies }}</td>
                                                    <td>{{ $current_donor->donor->medical_history }}</td>
                                                    <td>{{ $current_donor->date }}</td>
                                                    <td>
                                                        <button type="button" class="btn btn-primary openModalButton" data-donor-id="{{ $current_donor->donor->id }}">Donated</button>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <br><hr><br>
                        <div class="card border-0 shadow">
                            <div class="card-body">
                                <h5>All Donors</h5><hr>
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Gender</th>
                                                <th>Blood Type</th>
                                                <th>Allergies</th>
                                                <th>Medical History</th>
                                                <th>Date</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($donors as $donor)
                                                <tr>
                                                    <td>{{ $donor->donor->fname }} {{ $donor->donor->mname }} {{ $donor->donor->lname }}</td>
                                                    <td>
                                                        @if ($donor->donor->gender == 'male')
                                                            Male
                                                        @elseif($donor->donor->gender == 'female')
                                                            Female
                                                        @else
                                                            Other
                                                        @endif
                                                    </td>
                                                    <td>{{ $donor->donor->blood_type }}</td>
                                                    <td>{{ $donor->donor->allergies }}</td>
                                                    <td>{{ $donor->donor->medical_history }}</td>
                                                    <td>{{ $donor->date }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                
                        {{-- Modal --}}
                        <div class="modal" id="myModal" tabindex="-1" role="dialog">
                            <div class="modal-dialog" role="document">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title">Modal title</h5>
                                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                  <p>Input how many unit of blood taken.</p>
                                  <form action="{{ route('insertBloodUnit') }}" method="post">
                                    @csrf
                                    <div class="form-group">
                                        <label for="donor_id">Donor ID</label>
                                        <input type="text" class="form-control" id="donor_id" name="donor_id" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="blood_unit">How many blood unit take:</label>
                                        <input type="number" class="form-control" id="blood_unit" name="blood_unit" required>
                                    </div>
                                    <br>
                                    <div class="text-center">
                                        <input type="submit" class="btn btn-danger" value="SAVE">
                                    </div>
                                    
                                </form>
                                </div>
                              </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    @else
    <p>User not logged in.</p>
    <a href="{{ route('login_donor') }}">Login Here</a>
    @endif
    
    <script src="//cdn.datatables.net/2.0.7/js/dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script>
        $(

document).ready(function () {
            $('#donor-table').DataTable();

            $('.openModalButton').click(function(){
                $('#myModal').modal('show');
                var donorId = $(this).data('donor-id');
                $('#donor_id').val(donorId);
            });
        });
    </script>
  </body>
</html>