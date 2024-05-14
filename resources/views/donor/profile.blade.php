<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pofile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <script src="{{asset('js/jquery-3.3.1.js')}}"></script>
    <style>
      .header-color{
          background-color: #B61A20; 
      }
      .custom-color-side-bar{
          background-color: white; 
      }
  </style>
  </head>
  <body>
    @if(session()->has('user'))
    {{-- header dito --}}
    @include('donor.donor_header')

    {{-- sidebar dito --}}
    <div class="container-fluid">
      <div class="row flex-nowrap">
          <div class="col-auto col-md-3 col-xl-2 px-sm-2 px-0 custom-color-side-bar shadow">
              <div class="d-flex flex-column align-items-center align-items-sm-start px-3 pt-2 text-white min-vh-100">
                  <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start" id="menu">
                      <li class="nav-item">
                          <a href="{{ url('/home_donor') }}" class="nav-link align-middle px-0 ">
                              <i class="fs-4 bi-house"></i> <span class="ms-1 d-none d-sm-inline">Home</span>
                          </a>
                      </li>
                      <li>
                          <a href="{{ route('donor_donate') }}" class="nav-link px-0 align-middle">
                              <i class="fs-4 bi-droplet"></i> <span class="ms-1 d-none d-sm-inline">Donate</span> </a>
                      </li>
                      <li>
                          <a href="#" class="nav-link px-0 align-middle text-danger fw-bold fs-4">
                              <i class="fs-4 bi-person"></i> <span class="ms-1 d-none d-sm-inline">Profile</span></a>
                      </li>
                  </ul>
              </div>
          </div>
          <div class="col py-3">
            <div class="card border-0 shadow">
                <div class="card-body">
                    <div class="container">
                        <div class="row">
                            <div class="col">
                                <h3 class="float-start">Profile</h3>
                                <span class="float-end"><button class="text-decoration-none btn btn-danger fw-bold" onclick="openEditForm()" >Edit Profile</button></span>
                            </div>
                        </div>
                    </div>                    
                    <hr><br>

                    <div class="row">

                        <div class="col">
                            <div class="card border-0 shadow">
                                <div class="card-body">

                                    <h5 class="fw-bold">Personal Infomation</h5><hr>
                                    <div class="table-responsive">
                                        <table class="table table-hover">
                                            <thead>
                                                <tr>
                                                    <th>Name</th>
                                                    <th>Birthdate</th>
                                                    <th>Gender</th>
                                                    <th>Phone</th>
                                                    <th>Address</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>{{$donor->fname}} {{$donor->mname}} {{$donor->lname}} </td>
                                                    <td>{{$donor->birthdate}}</td>
                                                    <td>{{$donor->gender}}</td>
                                                    <td>{{$donor->phone}}</td>
                                                    <td>{{$donor->address}}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            
                        </div>
                        <div class="col">
                            @if (isset($status))
                                <div class="card border-0 shadow">
                                    <div class="card-body">
                                        <div class="text-center">
                                            <p class="fs-5">Profile set as <span class="text-danger fw-bold">{{$status->status == "1" ? "PUBLIC" : "PRIVATE"}}</span>. {{$status->status == "1" ? "Your contact infomation can be seen by blood seekers." : "Your contact infomation can not be seen by blood seekers"}}</p>
                                            <hr>
                                            <span>
                                                @if ($status->status == "1")
                                                    <a href="{{ route('privateProfile') }}" class="btn btn-primary">Private</a>
                                                @else
                                                    <a href="{{ route('publicProfile') }}" class="btn btn-danger">Public</a>
                                                @endif
                                                
                                                
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            @else
                                <div class="card border-0 shadow">
                                    <div class="card-body">
                                        <div class="text-center">
                                            <p class="fs-5">Show your donor profile publicly to help those in need, or keep it private?</p>
                                            <span>
                                                <a href="{{ route('privateProfile') }}" class="btn btn-primary">Private</a>
                                                <a href="{{ route('publicProfile') }}" class="btn btn-danger">Public</a>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            

                            <br>
                            <div class="card border-0 shadow">
                                <div class="card-body">

                                    <h5 class="fw-bold">Health Infomation</h5><hr>
                                    <div class="table-reponsive"></div>
                                        <table class="table table-hover">
                                            <thead>
                                                <tr>
                                                    <th>Blood Type</th>
                                                    <th>Allergies</th>
                                                    <th>Medical History</th>
                                                    <th>Height</th>
                                                    <th>Weight</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>{{$donor->blood_type}}</td>
                                                    <td>{{$donor->allergies}}</td>
                                                    <td>{{$donor->medical_history}}</td>
                                                    <td>{{$donor->height}}</td>
                                                    <td>{{$donor->weight}}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br><br>
                        @if (isset($success))
                            <div class="alert alert-success">
                                <p>{{$success}}</p>
                            </div>
                        @endif
                        <div class="card border-0 shadow p-3" id="edit-form">
                            <div class="card-body">
                                <h3>Edit form</h3><hr>

                                {{-- Edit Form --}}
                                <form action="{{ route('edit-profile') }}" method="POST">
                                    @csrf
                                    <div class="row">
                                        <div class="col">
                                            <label for="fname" class="form-label fw-bold">First Name: </label>
                                            <input type="text" name="fname" class="form-control" value="{{$donor->fname}}">
                                        </div>
                                        <div class="col">
                                            <label for="mname" class="form-label fw-bold">Middle Name: </label>
                                            <input type="text" name="mname" class="form-control" value="{{ $donor->mname }}">
                                        </div>
                                        <div class="col">
                                            <label for="lname" class="form-label fw-bold">Last Name: </label>
                                            <input type="text" name="lname" class="form-control" value="{{ $donor->lname }}">
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col">
                                            <label for="gender" class="fw-bold">Gender: </label>
                                            <div class="row">
                                                <div class="col">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="gender" id="male" value="male" {{ $donor->gender == "male" ? 'checked' : '' }}>
                                                        <label class="form-check-label" for="male">Male</label>                                            
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="gender" id="female" value="female" {{ $donor->gender == "female" ? 'checked' : '' }}>
                                                        <label class="form-check-label" for="female">Female</label>                                            
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="gender" id="other" value="other" {{ $donor->gender == "other" ? 'checked' : '' }}>
                                                        <label class="form-check-label" for="other">Other</label>                                            
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <label for="phone" class="form-label fw-bold">Phone Number: </label>
                                            <input type="tel" name="phone" class="form-control" value="{{ $donor->phone }}">
                                        </div>
                                        <div class="col">
                                            <label for="birthdate" class="form-label fw-bold">Birthdate: </label>
                                            <input type="date" name="birthdate" class="form-control" value={{ $donor->birthdate }}>
                                        </div>
                                    </div>
                                    <label for="address" class="fw-bold">Address: </label>
                                    <input type="text" class="form-control" name="address" id="address" value="{{ $donor->address }}">
            
                                    <br><br>
                                    {{-- DITO HEALTH INFORMATION --}}
                                    <h3 class="fw-bold">Health Information</h3><hr>
                                    <div class="row">
                                        <div class="col">
                                            <label for="blood_type" class="form-label fw-bold">Blood Type:</label>
                                            <select name="blood_type" id="blood_type" class="form-select">
                                                <option value="A+" {{ $donor->blood_type == "A+" ? "selected" : ''}}>A+</option>
                                                <option value="A-" {{ $donor->blood_type == "A-" ? "selected" : ''}}>A-</option>
                                                <option value="B+" {{ $donor->blood_type == "B+" ? "selected" : ''}}>B+</option>
                                                <option value="B-" {{ $donor->blood_type == "B-" ? "selected" : ''}}>B-</option>
                                                <option value="AB+" {{ $donor->blood_type == "AB+" ? "selected" : ''}}>AB+</option>
                                                <option value="AB-" {{ $donor->blood_type == "AB-" ? "selected" : ''}}>AB-</option>
                                                <option value="O+" {{ $donor->blood_type == "O+" ? "selected" : ''}}>O+</option>
                                                <option value="O-" {{ $donor->blood_type == "O-" ? "selected" : ''}}>O-</option>
                                            </select>
                                        </div>                                                  
                                        <div class="col">
                                            <label for="allergies" class="form-label fw-bold">Allergies: </label>
                                            <input type="text" name="allergies" class="form-control" value="{{ $donor->allergies }}">
                                        </div>
                                    </div><br>
                                    <label for="medical_history" class="fw-bold">Medical history (Any illnesses, surgeries, medications): </label>
                                    <input type="text" class="form-control" name="medical_history" id="medical_history" value="{{ $donor->medical_history }}"><br>
                                    <div class="row">
                                        <div class="col">
                                            <label for="height" class="form-label fw-bold">Height (in CM e.g. 150, 171, 123): </label>
                                            <input type="number" name="height" class="form-control" value="{{ $donor->height }}">
                                        </div>
                                        <div class="col">
                                            <label for="weight" class="form-label fw-bold">Weight (in KG e.g. 34, 55, 67): </label>
                                            <input type="number" name="weight" class="form-control" value="{{ $donor->weight }}">
                                        </div>
                                    </div>
                                    <br><br>
                                    <div class="text-center">
                                        <input type="submit" class="btn btn-danger fw-bold" value="Edit" style="width: 50%;">
                                    </div>                        
                                </form>
                                <br>
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
        });

        function openEditForm(){
            $('#edit-form').show();
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>