<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    public function center(){
        return $this->hasOne('App\Models\Center');
    }

    public function donationDrive(){
        return $this->hasMany('App\Models\DonationDrive');
    }
    use HasFactory;
}
