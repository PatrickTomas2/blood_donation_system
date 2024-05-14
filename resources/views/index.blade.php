<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Blood Donation System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <script src="{{asset('js/jquery-3.3.1.js')}}"></script>
    <style>
        .header-color{
            background-color: #B61A20; 
        }
        .custom-btn-register{
            background-color: white;
            color: #B61A20;
        }
        .custom-btn-register:hover{
            background-color: rgb(237, 24, 24);
            color: white;
        }
        .custom-btn-login{
            background-color: white;
            color: #B61A20;
        }
        .custom-btn-login:hover{
            background-color: rgb(237, 24, 24);
            color: white;
        }
        body{
            background-color: white;
        }
        .custom-btn{
            background-color: #B61A20;
            color: white;
        }
        .search-donor-container{
          background-color: #B61A20;
          border-radius: 50px;
        }
        .search-box {
          position: relative;
          display: flex;
          align-items: center;
          width: 500px;
          margin: 0 auto;
          background-color: #fff;
          border: 2px solid #ccc;
          border-radius: 25px;
          padding: 5px 15px;
          box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .search-box .search-icon {
          font-size: 20px;
          color: #888;
        }

        .search-box input {
          border: none;
          outline: none;
          flex-grow: 1;
          padding: 10px;
          font-size: 16px;
          border-radius: 25px;
        }

        .search-box input::placeholder {
          color: #888;
        }


    </style>

    </head>
  <body>
    <section class="header header-color">
        <div class="container">
          <nav class="navbar navbar-expand-lg navbar-dark">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">
                    <img src="{{asset('images/red-cross-logo.png')}}" alt="Logo" height="90">
                    <span class="ms-2 fs-5 fw-bold">Blood Donation System - Red Cross Pangasinan</span>
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                  <div class="collapse navbar-collapse" id="navbarSupportedContent">
                      <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                          <li class="nav-item">
                              <a class="nav-link act" aria-current="page" href="#">Donate Blood</a>
                          </li>
                          <li class="nav-item">
                              <a class="nav-link" href="#howToDonate">How to Donate?</a>
                          </li>
                          <li class="nav-item">
                              <a class="nav-link" href="#whereICanDonate">Where I Can Donate?</a>
                          </li>
                          <li class="nav-item">
                            {{-- <button type="button" class="btn fw-bold fs-5 custom-btn-register ms-3">Donate now</button> --}}
                            <a href="{{route('registration')}}" class="btn fw-bold fs-5 custom-btn-register ms-3">Donate now</a>
                          </li>
                          <li class="nav-item">
                            {{-- <button type="button" class="btn fw-bold fs-5 custom-btn-login ms-3">Login</button> --}}
                            <a href="{{route('login_donor')}}" class="btn fw-bold fs-5 custom-btn-register ms-3">Login</a>
                          </li>
                      </ul>
                  </div>
              </div>
          </nav>
    
            {{-- <div class="middle">
                <h1 class="text-white fw-bold">Get your <span class="theme-text">business permit today</span>.</h1>
            </div> --}}
        </div>
      </section>

        <section id="donate-blood" class="donate-blood" style="position: relative;">
            <img src="{{asset('images/blur_pic.jpg')}}" alt="Blood donation image" style="width: 100%; height: 500px;">
            <div class="top-text" style="position: absolute; top: 20px; left: 50%; transform: translateX(-50%); text-align: center; color: white; font-size: 18px;">
                <p>URDANETA CITY | DAGUPAN CITY | SAN CARLOS CITY</p>
            </div>
            <div class="middle-text" style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); text-align: center; color: white; font-size: 50px;">
                <h1 style="font-size: 110px;">"Donate Blood To Save <span style="color: #B61A20; font-weight: bold;">LIFE.</span>"</h1>
            </div>
        </section>
    
        <section class="bg-light py-3 py-md-5" id="howToDonate">
            <div class="container">
                <h1 class="h1 mb-3 fw-bold" style="color: #B61A20; font-size: 50px;">How to Donate?</h1>
              <br>
                <div class="row gy-5 gy-lg-0 align-items-lg-center">
                  <div class="row justify-content-xl-end">
                    <div class="col-12 col-xl-11">
                      <div class="accordion accordion-flush" id="accordionExample">
                        <div class="accordion-item">
                          <h2 class="accordion-header" id="headingOne">
                            <button class="accordion-button custom-btn fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                              HOW OFTEN CAN A PERSON DONATE?
                            </button>
                          </h2>
                          <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                              <p>A healthy individual may donate every three months.</p>
                            </div>
                          </div>
                        </div>
                        <div class="accordion-item">
                          <h2 class="accordion-header" id="headingTwo">
                            <button class="accordion-button custom-btn collapsed fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                              WILL DONATING BLOOD MAKE A PERSON WEAK?
                            </button>
                          </h2>
                          <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                              <p>No, it will not make you weak. Donating 450cc will not cause any ill effects or weakness. The human body has the capacity to compensate for the new fluid volume. Further, the bone marrow is stimulated to produce new blood cells which in turn makes the blood-forming organs function more effectively.</p>
                            </div>
                          </div>
                        </div>
                        <div class="accordion-item">
                          <h2 class="accordion-header" id="headingThree">
                            <button class="accordion-button custom-btn collapsed fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                              CAN A PERSON WHO HAS A TATTO OR BODY PIERCING STILL DONATE BLOOD?
                            </button>
                          </h2>
                          <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                              <p>If the tattooing procedure or the piercing was done a year ago, he/she may donate. This is also applicable to acupuncture, and other procedures involving needles.</p>
                            </div>
                          </div>
                        </div>
                        <div class="accordion-item">
                          <h2 class="accordion-header" id="headingFour">
                            <button class="accordion-button custom-btn collapsed fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                              HOW LONG IT WILL TAKE TO DONATE BLOOD?
                            </button>
                          </h2>
                          <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour" data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                              <p>The whole process of blood donation, from the registration up to the recovery, will only take an average of 30 minutes.</p>
                              <P>The blood extraction will take about 5-10 minutes. The blood volume will start replenishing within 24 hours. Theoretically, by the end of the month, the body will have the blood status before the blood donation.</P>
                            </div>
                          </div>
                        </div>
                        <div class="accordion-item">
                          <h2 class="accordion-header" id="headingFive">
                            <button class="accordion-button custom-btn collapsed fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                              WILL I CONTRACT THE DISEASE THROUGH BLOOD DONATION?
                            </button>
                          </h2>
                          <div id="collapseFive" class="accordion-collapse collapse" aria-labelledby="headingFive" data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                              <p>No, we use sterile, disposable needles and syringes.</p>
                            </div>
                          </div>
                        </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </section>

          <section class="bg-light py-3 py-md-5" id="whereICanDonate">
            <div class="container">
                <h1 class="h1 mb-3 fw-bold" style="color: #B61A20; font-size: 50px;">Blood Donation Drive</h1>
                <br>
                <div class="row">
                    <div class="col-6">
                        <img src="{{asset('images/blood_animated.png')}}" style="height: 550px;" alt="Blood Animated Image">
                    </div>
                    <div class="col-6">
                      <div class="card border-0 p-5 text-white shadow bg-danger" style="border-radius: 30px;">
                        <div class="cad-body">
                          <h1 class="fw-bold" style="font-size: 90px">Come and Donate</h1>
                        <hr>
                        @foreach ($donationDrives as $donationDrive)
                            <h2 class="fw-bold">@ {{$donationDrive->establishment_name}}, {{$donationDrive->address}}</h2><br>
                            <h4>{{$donationDrive->date}}</h4>
                            <h4>{{$donationDrive->start_time}} - {{$donationDrive->end_time}}</h4>
                            <h4>{{$donationDrive->phone}}</h4>
                        @endforeach
                        </div>
                      </div>
                    </div>
                </div>
            </div>
          </section>

          <section class="bg-light py-3 py-md-5" id="whereICanDonate">
            <div class="container p-5 search-donor-container">
              <div class="text-center">
                <h1 class="text-white fw-bold">Search for for donors.</h1>
                <p class="text-white">Search for a donor located near you and contact them using the information provided during registrations.</p>
                <br><br>
                <form action="#">
                  @csrf
                  <div class="search-box">
                     <i class="bi bi-search search-icon"></i>
                     <input type="text" name="search" id="search" placeholder="Search address...">
                  </div>
               </form>
               <br><br>
                  <table class="table table-hover" id="tableSearchResult">
                    <thead>
                        <tr>
                            <th>Name</th>
                            {{-- <th>Address</th> --}}
                            <th>Phone Number</th>
                            <th>Blood Type</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Results will be appended here by jQuery -->
                    </tbody>
                </table>
              </div>
            </div>
          </section>
    
    
    <script>
      $(document).ready(function (){
        $('#search').on('keyup', function() {
                let query = $(this).val();

                $.ajax({
                    url: '{{ route('search.donors') }}',
                    method: 'GET',
                    data: { query: query },
                    success: function(data) {
                        let tableBody = $('#tableSearchResult tbody');
                        tableBody.empty();

                        data.forEach(function(donor) {
                            tableBody.append(`
                                <tr>
                                    <td>${donor.donor.fname} ${donor.donor.lname}</td>
                                    
                                    <td>${donor.donor.phone}</td>
                                    <td>${donor.donor.blood_type}</td>
                                </tr>
                            `);
                        });
                    }
                });
            });
      });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>