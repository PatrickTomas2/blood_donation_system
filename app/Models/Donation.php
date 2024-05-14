<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Donation extends Model
{

    public function donor(){
        return $this->belongsTo('App\Models\Donor', 'donor_id');
    }

    public function center(){
        return $this->belongsTo('App\Models\Center', 'center_id');
    }

    public function schedule(){
        return $this->belongsTo('App\Models\Schedule', 'schedule_id');
    }
    use HasFactory;
}
