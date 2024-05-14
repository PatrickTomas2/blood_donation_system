<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    public function center(){
        return $this->belongsTo('App\Models\Center', 'center_id');
    }

    public function donations(){
        return $this->hasMany('App\Models\Donation');
    }
    use HasFactory;
}
