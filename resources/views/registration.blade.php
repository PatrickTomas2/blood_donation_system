<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Donor Registration</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        .header-color{
            background-color: #B61A20; 
        }
        .btn-custom{
            width: 50%;
            background-color: #B61A20;
            color: white;
        }
        .btn-custom:hover{
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
        
        <br><br>

        <div class="container">
            <div class="card border-0 shadow p-3">
                <div class="card-body">
                    <h1 class="fw-bold">Donor Registration Form</h1>
                    <p>Please answer this form truthfully. If a question does not apply to you, simply write N/A.</p>
                    <hr><br>
                    {{-- This is the FORM --}}
                    <form action="{{route('storeDonor')}}" method="POST">
                        @csrf
                        <h3 class="fw-bold">Personal Information</h3><hr>
                        <div class="row">
                            <div class="col">
                                <label for="fname" class="form-label fw-bold">First Name: </label>
                                <input type="text" name="fname" class="form-control" value="{{ old('fname') }}" placeholder="First name">
                                {{-- DITO ANG ERROR HANDLING --}}
                                @error('fname')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="col">
                                <label for="mname" class="form-label fw-bold">Middle Name: </label>
                                <input type="text" name="mname" class="form-control" value="{{ old('mname') }}" placeholder="Middle name">
                                @error('mname')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="col">
                                <label for="lname" class="form-label fw-bold">Last Name: </label>
                                <input type="text" name="lname" class="form-control" value="{{ old('lname') }}" placeholder="Last name">
                                @error('lname')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col">
                                <label for="gender" class="fw-bold">Gender: </label>
                                <div class="row">
                                    <div class="col">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="gender" id="male" value="male" {{ old('gender') == 'male' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="male">Male</label>                                            
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="gender" id="female" value="female" {{ old('gender') == 'female' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="female">Female</label>                                            
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="gender" id="other" value="other" {{ old('gender') == 'other' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="other">Other</label>                                            
                                        </div>
                                    </div>
                                </div>
                                @error('gender')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="col">
                                <label for="phone" class="form-label fw-bold">Phone Number: </label>
                                <input type="tel" name="phone" class="form-control" placeholder="Phone number" value={{ old('phone') }}>
                                @error('phone')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="col">
                                <label for="birthdate" class="form-label fw-bold">Birthdate: </label>
                                <input type="date" name="birthdate" class="form-control" placeholder="Birthdate" value={{ old('birthdate') }}>
                                @error('birthdate')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <label for="address" class="fw-bold">Address: </label>
                        <input type="text" class="form-control" name="address" id="address" placeholder="Enter address" value="{{ old('address') }}">
                        @error('address')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror

                        <br><br>
                        {{-- DITO HEALTH INFORMATION --}}
                        <h3 class="fw-bold">Health Information</h3><hr>
                        <div class="row">
                            <div class="col">
                                <label for="blood_type" class="form-label fw-bold">Blood Type:</label>
                                <select name="blood_type" id="blood_type" class="form-select">
                                    <option value="">--SELECT--</option>
                                    <option value="A+" {{ old('blood_type') == 'A+' ? 'selected' : '' }}>A+</option>
                                    <option value="A-" {{ old('blood_type') == 'A-' ? 'selected' : '' }}>A-</option>
                                    <option value="B+" {{ old('blood_type') == 'B+' ? 'selected' : '' }}>B+</option>
                                    <option value="B-" {{ old('blood_type') == 'B-' ? 'selected' : '' }}>B-</option>
                                    <option value="AB+" {{ old('blood_type') == 'AB+' ? 'selected' : '' }}>AB+</option>
                                    <option value="AB-" {{ old('blood_type') == 'AB-' ? 'selected' : '' }}>AB-</option>
                                    <option value="O+" {{ old('blood_type') == 'O+' ? 'selected' : '' }}>O+</option>
                                    <option value="O-" {{ old('blood_type') == 'O-' ? 'selected' : '' }}>O-</option>
                                </select>
                                @error('blood_type')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>                                                  
                            <div class="col">
                                <label for="allergies" class="form-label fw-bold">Allergies: </label>
                                <input type="text" name="allergies" class="form-control" placeholder="Allergies" value="{{ old('allergies') }}">
                                @error('allergies')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div><br>
                        <label for="medical_history" class="fw-bold">Medical history (Any illnesses, surgeries, medications): </label>
                        <input type="text" class="form-control" name="medical_history" id="medical_history" placeholder="Enter medical history" value="{{ old('medical_history') }}"><br>
                        @error('medical_history')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                        <div class="row">
                            <div class="col">
                                <label for="height" class="form-label fw-bold">Height (in CM e.g. 150, 171, 123): </label>
                                <input type="number" name="height" class="form-control" placeholder="Height" value="{{ old('height') }}">
                                @error('height')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                                {{-- DITO ANG ERROR HANDLING --}}
                            </div>
                            <div class="col">
                                <label for="weight" class="form-label fw-bold">Weight (in KG e.g. 34, 55, 67): </label>
                                <input type="number" name="weight" class="form-control" placeholder="Weight" value="{{ old('weight') }}">
                                @error('weight')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <br><br>
                        {{-- DITO LOGIN INFORMATION --}}
                        <h3 class="fw-bold">Login Credentials</h3><hr>
                        <div class="row">
                            <div class="col">
                                <label for="username" class="form-label fw-bold">Username: </label>
                                <input type="text" name="username" class="form-control" placeholder="Username" value="{{ old('username') }}">
                                @error('username')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                                {{-- DITO ANG ERROR HANDLING --}}
                            </div>
                            <div class="col">
                                <label for="password" class="form-label fw-bold">Password: </label>
                                <input type="password" name="password" class="form-control" placeholder="Password">
                                @error('password')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <br><br>
                        <div class="text-center">
                            <input type="submit" class="btn btn-custom" value="REGISTER">
                        </div>                        
                    </form>
                </div>
            </div>
        </div>
        
        


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>