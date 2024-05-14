<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Home</title>
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
                          <a href="#" class="nav-link px-0 align-middle text-danger fw-bold fs-4">
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
            {{-- <h1>Donate Form</h1>
            <h1>{{session('user')}}</h1>
            <h1>{{ $donor->fname }}</h1> --}}
            @if (isset($error))
                <div class="card border-0 shadow">
                    <div class="card-body text-center">
                        <h1 class="text-danger fw-bold">Sorry...</h1>
                        <h5>{{$error}}</h5>
                    </div>
                </div>
            
            @else
                {{-- If Pwede --}}

                <div class="card border-0 shadow">
                    <div class="card-body">
                        
                        <div class="card">
                            <div class="card-body">
                                <h5>Reminder:</h5>
                                <ul>
                                    <li>You must be in good health.</li>
                                    <li>Sleep: at least 5-6 hours of quality sleep.</li>
                                    <li>No alcohol intake within 12 hours.</li>
                                    <li>Tatto, piercing and surgery must be at least 1 year old.</li>
                                </ul>

                                <h5>Additional Blood Donor Deferral Criteria: </h5>
                                <ul>
                                    <li>28 days deferral for donors with close contact with persons under investigation or confirmed for Novel Corona Virus infection.</li>
                                    <li>In the past 4 weeks have colds, cough, and/or fever.</li>
                                    <li>Have come in contact with persons having signs of respiratory distress.</li>
                                </ul>
                            </div>
                        </div>
                        <br>
                        <h3>Donation Form</h3><hr><br>
                        @if(isset($success))
                            <div class="alert alert-success">
                                {{ $success }}
                            </div>
                        @endif

                        @if(isset($errorForm))
                            <div class="alert alert-danger">
                                {{ $errorForm }}
                            </div>
                        @endif
                        <form action="{{ route('submit-donation-form') }}" method="post">
                            @csrf
                            <label for="bloodCenter" class="fw-bold">Blood Donation Centers: </label>
                            <select name="bloodCenter" id="bloodCenter" class="form-control" required>
                                @foreach ($centers as $center)
                                    <option value="{{$center->id}}">{{$center->center_name}}</option>
                                @endforeach
                            </select>
                            <br>
                            <div class="row">
                                <div class="col">
                                    <label for="schedule">Select schedue:</label>
                                    <select name="schedule" id="schedule" class="form-control" required>
                                        {{-- @foreach ($schedules as $schedule)
                                            <option value="{{$schedule->id}}">{{$schedule->day}} {{$schedule->start_date}} {{$schedule->end_time}}</option>
                                        @endforeach --}}
                                    </select>
                                </div>
                                <div class="col">
                                    <label for="date">Select date:</label>
                                    <input type="date" name="date" id="date" min="{{$currentDate}}" class="form-control" required>
                                </div>
                            </div>
                            <br><br>
                            <div class="text-center">
                                <input type="submit" class="btn btn-danger" value="Save" style="width: 50%;">
                            </div><br>
                        </form>
                        
                    </div>
                </div>
            @endif

          </div>
      </div>
  </div>
    @else
        <p>User not logged in.</p>
        <a href="{{route('login_donor')}}">Login Here</a>
    @endif

    <script>
        $(document).ready(function () {
            
            $('#bloodCenter').change(function() {
                var selectedId = $(this).val();
                if (selectedId) {
                    $.ajax({
                        url: '/get-second-options/' + selectedId,
                        type: 'GET',
                        dataType: 'json',
                        success: function(data) {
                            var select = $('#schedule');
                            select.empty();
                            $.each(data, function(key, value) {
                                select.append('<option value="' + value.id + '">' + value.day + ". " + value.start_time  + " - " + value.end_time +'</option>');
                            });
                        },
                        error: function(xhr, status, error) {
                            console.error('An error occurred while fetching data:', error);
                        }
                    });
                } else {
                    $('#schedule').empty();
                }
            });

            
        });
    </script>
    

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>