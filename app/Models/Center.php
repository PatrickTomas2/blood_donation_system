<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Center extends Model
{
    protected $fillable = [
        'admin_id',
        'center_name',
        'street',
        'barangay',
        'town',
        'day',
        'start_time',
        'end_time',
    ];

    public function admin(){
        return $this->belongsTo('App\Models\Admin', 'admin_id');
    }

    public function schedules(){
        return $this->hasMany('App\Models\Schedule');
    }
    
    public function donations(){
        return $this->hasMany('App\Models\Donation');
    }

    public function donatedBloods(){
        return $this->hasMany('App\Models\DonatedBlood');
    }
    use HasFactory;
}
