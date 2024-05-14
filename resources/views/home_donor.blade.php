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
                          <a href="#" class="nav-link align-middle px-0 text-danger fw-bold fs-4">
                              <i class="fs-4 bi-house"></i> <span class="ms-1 d-none d-sm-inline">Home</span>
                          </a>
                      </li>
                      <li>
                          <a href="{{ route('donor_donate') }}" class="nav-link px-0 align-middle">
                              <i class="fs-4 bi-droplet"></i> <span class="ms-1 d-none d-sm-inline">Donate</span> </a>
                      </li>
                      <li>
                          <a href="{{ route('profile') }}" class="nav-link px-0 align-middle">
                              <i class="fs-4 bi-person"></i> <span class="ms-1 d-none d-sm-inline">Profile</span></a>
                      </li>
                  </ul>
              </div>
          </div>
          <div class="col py-3">

            <div class="card border-0 shadow">
              <div class="card-body">
                <h3 class="fw-bold">Welcome, {{$donor->fname}}</h3>
              </div>
            </div>
            <br>
            <div class="row">

              <div class="col">
                <div class="row">
                  <div class="col">
                    <div class="card border-0 shadow" style="height: auto;">
                      <div class="card-body">
                        <div class="text-center">
                          <p class="fw-bold">Total unit/s of donated blood</p>
                          @if ($donated_blood != null)
                              <h3>{{$donated_blood->blood_unit}}</h3>
                          @else
                              <h3>0</h3>
                          @endif
                          
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <div class="col">
                <div class="card border-0 shadow p-2" style="height: auto;">
                  <div class="card-body">
                    <div class="text-center">
                      <div class="card p-2" style="background-color: #B61A20;">
                        <h4 class="text-white">Blood Donation Drive</h4>
                      </div>
                    
                      <br>
                      <p>We're having a blood donatin drive, come and join us.</p>
                      @foreach ($donationDrives as $donationDrive)
                        <h5>@ {{$donationDrive->establishment_name}}, {{$donationDrive->address}}</h5>
                        <br>
                        <h5>{{$donationDrive->date}}. {{$donationDrive->start_time}} - {{$donationDrive->end_time}}</h5>
                        <p>Call us: <span class="fw-bold">{{$donationDrive->phone}}</span></p>
                      @endforeach
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
        <a href="{{route('login_donor')}}">Login Here</a>
    @endif
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>