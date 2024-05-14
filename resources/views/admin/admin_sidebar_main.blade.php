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
                        <a href="{{ route('dashboard_admin') }}" class="nav-link px-0 align-middle">
                            <i class="fs-4 bi-speedometer2"></i> <span class="ms-1 d-none d-sm-inline">Donor List</span> </a>
                    </li>
                    <li>
                        <a href="{{ route('center_information_admin') }}" class="nav-link px-0 align-middle">
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
            <div class="card border-0 shadow">
                <div class="card-body">
                    <h4 class="fw-bold">Hello admin, {{$admin->name}}</h4>
                </div>
            </div>
            <br>
            <div class="row mb-4">
                @foreach ($totals as $type => $total)
                <div class="col-md-3">
                    <div class="card border-0 shadow">
                        <div class="card-body">
                            <div class="text-center">
                                <h3>{{ $type }}</h3>
                                <hr>
                                <p class="fs-3">{{ $total }} unit/s of blood</p>
                            </div>
                        </div>
                    </div>
                    <br><br>
                </div>
                @endforeach
            </div>
            

        </div>
    </div>
</div>