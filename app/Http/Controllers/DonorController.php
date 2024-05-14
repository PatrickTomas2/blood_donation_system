<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Http\Requests\RegistrationRequest;
use App\Models\Donor;
use App\Models\Center;
use App\Models\Schedule;
use App\Models\DonationDrive;
use App\Models\Donation;
use App\Models\DonorActiveStatus;
use App\Models\DonatedBlood;

class DonorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('registration');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RegistrationRequest $request)
    {
        if ($request->validated()) {
            // echo 'foom is valid';
            // dd($request->blood_type);
            $donor = new Donor();

            $donor->fname = $request->fname;
            $donor->mname = $request->mname;
            $donor->lname = $request->lname;
            $donor->gender = $request->gender;
            $donor->phone = $request->phone;
            $donor->birthdate = $request->birthdate;
            $donor->address = $request->address;
            $donor->blood_type = $request->blood_type;
            $donor->allergies = $request->allergies;
            $donor->medical_history = $request->medical_history;
            $donor->height = $request->height;
            $donor->weight = $request->weight;
            $donor->username = $request->username;
            $donor->password = $request->password;

            $donor->save();

            return view('login_donor');

        } else {
            return redirect()->back()->withErrors($validator)->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function login(Request $request){
        $donor = Donor::where('username', $request->username)->first();
        if ($donor == null || $donor->password != $request->password) {
            return redirect()->back()->withErrors(['error' => 'Invalid credentials. (Email/Password Incorrect)']);
        }


        $request->session()->put('user', $donor->id);
        return redirect('/home_donor');
    }

    public function homeDonor(){
        $donor = Donor::find(session('user'));
        $donated_blood = DonatedBlood::where('donor_id', $donor->id)->first();

        // dd($donor->id);

        $donationDrives = DonationDrive::where('status', '0')->get();

        // Format the timestamps into human-readable time
        $donationDrives->transform(function ($drive) {
            $drive->start_time = date('h:i A', strtotime($drive->start_time));
            $drive->end_time = date('h:i A', strtotime($drive->end_time));
            $drive->date = date('F d, Y', strtotime($drive->date));
            return $drive;
        });

        // if ($donated_blood != null) {
            return view('home_donor', compact('donor', 'donationDrives', 'donated_blood'));
        // }else

        
    }

    public function donateDonor(){
        $donor = Donor::find(session('user'));
        $centers = Center::all();
        $currentDate = date('Y-m-d');

        if ($donor->weight >= 50.00) {
            return view('donor.donor_donate', compact('donor', 'centers', 'currentDate'));
            // echo "Pwede";
        }else{
            return view('donor.donor_donate', compact('donor'), ['error' => 'Your weight must be at least 50kg to donote.']);
            // echo "di pwede";
        }
        
    }

    //Get options on the second selection in the donate form
    public function getSecondOptions($id){

        $schedules = Schedule::where('center_id', $id)->get();

        // Convert time format to human-readable
        foreach ($schedules as $schedule) {
            $schedule->start_time = Carbon::parse($schedule->start_time)->format('g:i A');
            $schedule->end_time = Carbon::parse($schedule->end_time)->format('g:i A');
        }

        return response()->json($schedules);
    }
    

    public function logout(Request $request){
        $request->session()->forget('user');
        return redirect('login_donor');
    }
    
    //save donation form
    public function submitDonationForm(Request $request){
        $donor = Donor::find(session('user'));
        $donation = new Donation();
        $centers = Center::all();
        $currentDate = date('Y-m-d');
        //Date
        $request_date = $request->date;
        $date = Carbon::parse($request_date);
        $dayOfWeek = $date->dayOfWeek;

        if ($donor->weight >= 50.00) {
            if ($request->bloodCenter == "1") {
                if ($dayOfWeek != Carbon::MONDAY && $dayOfWeek != Carbon::WEDNESDAY && $dayOfWeek != Carbon::FRIDAY) {
                    return view('donor.donor_donate', compact('donor', 'centers', 'currentDate'), ['errorForm'=>'Date is Invalid']);
                  }else {
                      $donation->donor_id = $donor->id;
                      $donation->center_id = $request->bloodCenter;
                      $donation->schedule_id = $request->schedule;
                      $donation->date = $request->date;
      
                      $donation->save();
      
                      return view('donor.donor_donate', compact('donor', 'centers', 'currentDate'), ['success'=>'Donation Appointment saved.']);
                  }
              }elseif ($request->bloodCenter == "2") {
                  if ($dayOfWeek != Carbon::TUESDAY && $dayOfWeek != Carbon::WEDNESDAY && $dayOfWeek != Carbon::THURSDAY) {
                    return view('donor.donor_donate', compact('donor', 'centers', 'currentDate'), ['errorForm'=>'Date is Invalid']);
                  }else {
                      $donation->donor_id = $donor->id;
                      $donation->center_id = $request->bloodCenter;
                      $donation->schedule_id = $request->schedule;
                      $donation->date = $request->date;
      
                      $donation->save();
      
                      return view('donor.donor_donate', compact('donor', 'centers', 'currentDate'), ['success'=>'Donation Appointment saved.']);
                  }
              }elseif ($request->bloodCenter == "3") {
                  if ($dayOfWeek != Carbon::MONDAY && $dayOfWeek != Carbon::WEDNESDAY && $dayOfWeek != Carbon::THURSDAY) {
                    return view('donor.donor_donate', compact('donor', 'centers', 'currentDate'), ['errorForm'=>'Date is Invalid']);
                  }else {
                      $donation->donor_id = $donor->id;
                      $donation->center_id = $request->bloodCenter;
                      $donation->schedule_id = $request->schedule;
                      $donation->date = $request->date;
      
                      $donation->save();
      
                      return view('donor.donor_donate', compact('donor', 'centers', 'currentDate'), ['success'=>'Donation Appointment saved.']);
                  }
              }
      
        }else {
            return view('donor.donor_donate', compact('donor'), ['error' => 'Your weight must be at least 50kg to donote.']);
        }

    }

    //Profile Part
    public function openProfilePage(){
        $donor = Donor::find(session('user'));
        $status= DonorActiveStatus::with('donor')->where('donor_id', $donor->id)->first();

        if ($status == null) {
            return view('donor.profile', compact('donor'));
        }else {
            return view('donor.profile', compact('donor', 'status'));
        }

        
    }

    public function editProfileInfo(Request $request){
        // dd($request->blood_type);

        $donor = Donor::find(session('user'));

        $donor->fname = $request->fname;
        $donor->mname = $request->mname;
        $donor->lname = $request->lname;
        $donor->gender = $request->gender;
        $donor->phone = $request->phone;
        $donor->birthdate = $request->birthdate;
        $donor->address = $request->address;
        $donor->blood_type = $request->blood_type;
        $donor->allergies = $request->allergies;
        $donor->medical_history = $request->medical_history;
        $donor->height = $request->height;
        $donor->weight = $request->weight;

        $donor->save();
        return view('donor.profile', compact('donor'), ['success'=>'Updated the profile sucessfully.']);
    }

    public function publicProfile (){
        $donor = Donor::find(session('user'));
        $status= DonorActiveStatus::with('donor')->where('donor_id', $donor->id)->first();

        $donor_active_status = new DonorActiveStatus();

        if ($status == null) {
            $donor_active_status->donor_id = $donor->id;
            $donor_active_status->status = '1';

            $donor_active_status->save();

            $status = DonorActiveStatus::with('donor')->where('donor_id', $donor->id)->first();

            return view('donor.profile', compact('donor', 'status'));
        }else {
            $status->status = '1';
            $status->save();

            return view('donor.profile', compact('donor', 'status'));
        }

    }

    public function privateProfile (){
        $donor = Donor::find(session('user'));
        $status= DonorActiveStatus::with('donor')->where('donor_id', $donor->id)->first();

        $donor_active_status = new DonorActiveStatus();

        if ($status == null) {
            $donor_active_status->donor_id = $donor->id;
            $donor_active_status->status = '0';

            $donor_active_status->save();

            $status = DonorActiveStatus::with('donor')->where('donor_id', $donor->id)->first();

            return view('donor.profile', compact('donor', 'status'));
        }else {
            $status->status = '0';
            $status->save();

            return view('donor.profile', compact('donor', 'status'));
        }
    }

    public function search(Request $request)
    {
        $query = $request->search;

        $donors = DonorActiveStatus::with('donor')
            ->where('status', '1')
            ->whereHas('donor', function($query) use ($request) {
                $query->where('address', 'LIKE', '%' . $request->input('query') . '%');
            })
            ->get();

        return response()->json($donors);
    }
}
