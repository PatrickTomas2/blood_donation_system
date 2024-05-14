<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Donor extends Model
{
    protected $fillable = [
        'fname',
        'mname',
        'lname',
        'gender',
        'phone',
        'birthdate',
        'address',
        'blood_type',
        'allergies',
        'medical_history',
        'height',
        'weight',
        'username',
        'password',
    ];

    public function donations(){
        return $this->hasMany('App\Models\Donation');
    }

    public function donorActiveStatus (){
        return $this->hasOne('App\Models\DonorActiveStatus');
    }

    public function donatedBloods(){
        return $this->hasMany('App\Models\DonatedBlood');
    }
    use HasFactory;
}
