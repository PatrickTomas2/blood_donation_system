<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DonorController;
use App\Http\Controllers\AdminController;


// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [AdminController::class, 'index']);

//Go to registration
Route::get('/register', [DonorController::class, 'create'])->name('registration');

//Go to login donor
Route::get('/login_donor', function(){
    return view('login_donor');
})->name('login_donor');

//Process info nang login donor
Route::post('/login_donor', [DonorController::class, 'login'])->name('login');

//punta Home Donor
Route::get('/home_donor', [DonorController::class, 'homeDonor']);

Route::get('/home_admin', [AdminController::class, 'homeAdmin']);

//donor punta sa donote side bar
Route::get('/donate', [DonorController::class, 'donateDonor'])->name('donor_donate');

//Go to login admin
Route::get('/login_admin', function(){
    return view('login_admin');
})->name('login_admin');

//Logout dito user_donor
Route::get('/logout', [DonorController::class, 'logout'])->name('logout');

Route::post('/storeDonor', [DonorController::class, 'store'])->name('storeDonor');

//Login Admin
Route::post('/login_admin', [AdminController::class, 'login'])->name('login_admin');

//Logout na admin
Route::get('/logout_admin', [AdminController::class, 'logout'])->name('logout_admin');

//admin punta sa dashboad sa saidebar
Route::get('/dashboard', [AdminController::class, 'dashboardAdmin'])->name('dashboard_admin');

//admin punta sa center information sa sidebar
Route::get('/centerInformation', [AdminController::class, 'centerInformation'])->name('center_information_admin');

//admin punta sa blood donation drive sa sidebar
Route::get('/bloodDonationDrive', [AdminController::class, 'bloodDonationDrive'])->name('blood_donation_drive_admin');

//Edit Center info and sched
Route::post('/editCenterSched/{id}', [AdminController::class, 'editCenterSched'])->name('editCenterSched');

//add new blood donation drive
Route::post('/addNewBloodDonationDrive', [AdminController::class, 'addNewBloodDonationDrive'])->name('addNewBloodDonationDrive');

//Edit blood donation statud
Route::get('/editStatus/{id}', [AdminController::class, 'editStatus'])->name('editStatus');

//Delete blood donation drive
Route::get('/deleteDonationDrive/{id}', [AdminController::class, 'deleteDonationDrive'])->name('deleteDonationDrive');

//Get options on the second selection in the donate form
Route::get('/get-second-options/{id}', [DonorController::class, 'getSecondOptions'])->name('get-second-option');

//Save Donation Form from donor
Route::post('/saveDonationForm', [DonorController::class, 'submitDonationForm'])->name('submit-donation-form');

//Dito yung sa Profile
Route::get('/profile', [DonorController::class, 'openProfilePage'])->name('profile');

//Edit Pofile or donor info
Route::post('editProfile', [DonorController::class, 'editProfileInfo'])->name('edit-profile');

//public profile
Route::get('/publicProfile', [DonorController::class, 'publicProfile'])->name('publicProfile');
Route::get('/privateProfile', [DonorController::class, 'privateProfile'])->name('privateProfile');

//Insert unit of blood donated
Route::post('/unitBlood', [AdminController::class, 'insertBloodUnit'])->name('insertBloodUnit');

//Search Donor sa index
Route::get('/search-donors', [DonorController::class, 'search'])->name('search.donors');

//Sample
Route::get('sampleScreen/{id}', function ($id){
    return view('sample', ['id'=>$id]);
})->name('sample');