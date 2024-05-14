<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\Donor;
use App\Models\Center;
use App\Models\Schedule;
use App\Models\DonationDrive;
use App\Models\Donation;
use App\Models\DonatedBlood;

class AdminController extends Controller
{
    public function index(){
        $donationDrives = DonationDrive::where('status', '0')->get();

        // Format the timestamps into human-readable time
        $donationDrives->transform(function ($drive) {
            $drive->start_time = date('h:i A', strtotime($drive->start_time));
            $drive->end_time = date('h:i A', strtotime($drive->end_time));
            $drive->date = date('F d, Y', strtotime($drive->date));
            return $drive;
        });        

        return view('index', compact('donationDrives'));


    }

    public function login(Request $request){
        $admin = Admin::where('username', $request->username)->first();
        // dd($admin->username);
        if ($admin == null || $admin->password != $request->password) {
            return redirect()->back()->withErrors(['error' => 'Invalid credentials. (Email/Password Incorrect)']);
        }
        // dd($request->username);
        $request->session()->put('admin', $admin->id);
        return redirect('/home_admin');
    }

    public function logout(Request $request){
        $request->session()->forget('admin');
        return redirect('login_admin');
    }

    public function homeAdmin()
    {
        $admin = Admin::find(session('admin'));
        $donated = DonatedBlood::with('donors')->where('center_id', $admin->id)->get();

        $totals = [
            'A+' => 0,
            'A-' => 0,
            'B+' => 0,
            'B-' => 0,
            'AB+' => 0,
            'AB-' => 0,
            'O+' => 0,
            'O-' => 0,
        ];

        foreach ($donated as $value) {
            $totals[$value->donors->blood_type] += $value->blood_unit;
        }

        // foreach ($totals as $type => $total) {
        //     echo "Total units for blood type $type: $total <br>";
        // }

        // return view('home_admin', compact('admin'));
        return view('home_admin', compact('admin', 'totals'));
    }

    public function dashboardAdmin()
    {
        $admin = Admin::find(session('admin'));

        // Fetch all donors for the admin's center
        $donors = Donation::with(['donor', 'center', 'schedule'])
                        ->where('center_id', $admin->id)
                        ->get();

        // Fetch current donors for today
        $current_donors = Donation::with(['donor', 'center', 'schedule'])
                                ->where('center_id', $admin->id)
                                ->whereDate('date', today())
                                ->get();

        // Fetch all donated blood records
        $donated_blood = DonatedBlood::all();

        // Filter out donors from $current_donors if they have already donated
        $current_donors = $current_donors->filter(function ($donation) use ($donated_blood) {
            return !$donated_blood->contains('donor_id', $donation->donor->id);
        });

        return view('admin.admin_sidebar_dashboard', compact('admin', 'donors', 'current_donors', 'donated_blood'));
    }


    public function centerInformation()
    {
        // $center = Center::with('admin')->where('admin_id', session('admin'))->first();
        // $schedules = Schedule::with('center')->where('center_id', $center->id)->get();

        // $admin = Admin::find(session('admin'));
        // return view('admin.admin_center_info', compact('admin', 'center', 'schedules'));

        $center = Center::where('admin_id', session('admin'))->first();
        $schedules = $center ? $center->schedules : collect();

        $admin = Admin::find(session('admin'));
        return view('admin.admin_center_info', compact('admin', 'center', 'schedules'));
    }

    public function editCenterSched(Request $request, $id){
        $admin = Admin::find($id);
        $center = Center::where('admin_id', $id)->first();

        $center->center_name = $request->center_name;
        $center->street = $request->street;
        $center->barangay = $request->barangay;
        $center->town = $request->town;
        $center->save();

        $schedules = Schedule::where('center_id', $center->id)->get();

        foreach ($schedules as $index => $schedule) {
            $schedule->day = $request->input("day_$index");
            $schedule->start_time = $request->input("start_time_$index");
            $schedule->end_time = $request->input("end_time_$index");
            $schedule->save();
        }

        return view('admin.admin_center_info', compact('admin', 'center', 'schedules'), ['success'=>'Updated successfully']);

    }

    public function bloodDonationDrive(){
        $donationDrives = DonationDrive::where('admin_id', session('admin'))->get();

        // if ($donationDrives->isEmpty()) {
        //     echo "null or empty";
        // } else {
        //     echo "not null or not empty";
        //     You can also use dd($donationDrives); here to dump the contents
        // }


        $admin = Admin::find(session('admin'));
        return view('admin.admin_donation_drive', compact('admin', 'donationDrives'));
    }

    //ADD new blood donation drive
    public function addNewBloodDonationDrive(Request $request){
        $hasStatusOngoing = false;
        $donationDriveStatus = DonationDrive::pluck('status');

        foreach ($donationDriveStatus as $value) {
            if ($value == '0') {
                $hasStatusOngoing = true;
            }
        }

        if (!$hasStatusOngoing) {
            $admin = Admin::find(session('admin'));

            $donationDrive = new DonationDrive();
            $donationDrive->admin_id = $admin->id;
            $donationDrive->establishment_name = $request->establishment_name;
            $donationDrive->address = $request->address;
            $donationDrive->start_time = $request->start_time;
            $donationDrive->end_time = $request->end_time;
            $donationDrive->phone = $request->phone;
            $donationDrive->status = '0';
            $donationDrive->date = $request->date;

            $donationDrive->save();

            $donationDrives = DonationDrive::where('admin_id', session('admin'))->get();
            return view('admin.admin_donation_drive', compact('admin', 'donationDrives'), ['success'=>'Added successfully']);

        }else {
            $admin = Admin::find(session('admin'));
            $donationDrives = DonationDrive::where('admin_id', session('admin'))->get();
            return view('admin.admin_donation_drive', compact('admin', 'donationDrives'), ['error'=>'There is ongoing blood donation drive. Try adding after the donation drive status is done.']);
        }
        
    }

    public function editStatus($donationDrive_id){
        $donationDrive = DonationDrive::where('id', $donationDrive_id)->first();
        //dd($donationDrive->status);
        if ($donationDrive->status == '0') {
            $donationDrive->status = '1';
            $donationDrive->save();
        }else {
            $donationDrive->status = '0';
            $donationDrive->save();
        }

        $admin = Admin::find(session('admin'));
        $donationDrives = DonationDrive::where('admin_id', session('admin'))->get();
        return view('admin.admin_donation_drive', compact('admin', 'donationDrives'), ['success'=>'Status Updated successfully']);
    }

    public function deleteDonationDrive($donationDrive_id){
        $donationDrive = DonationDrive::find($donationDrive_id);
        $donationDrive->delete();

        $admin = Admin::find(session('admin'));
        $donationDrives = DonationDrive::where('admin_id', session('admin'))->get();
        return view('admin.admin_donation_drive', compact('admin', 'donationDrives'), ['success'=>'Deleted successfully']);
    }

    //Unit of Blood Donated
    public function insertBloodUnit(Request $request)
    {
        // Find the donation center associated with the donor
        $donation_center = Donation::with('center')->where('donor_id', $request->donor_id)->first();
        // dd($donation_center->center->center_id);
        // Create a new DonatedBlood entry
        $donated = new DonatedBlood();
        $donated->donor_id = $request->donor_id;
        $donated->center_id = $donation_center->center->id;
        $donated->blood_unit = $request->blood_unit;
        $donated->save();

        // Redirect to the admin sidebar dashboard
        return redirect()->route('dashboard_admin')->with(['success' => 'Donor blood unit has been recorded successfully.']);
    }


}
