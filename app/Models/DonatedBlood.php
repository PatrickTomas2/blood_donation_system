<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DonatedBlood extends Model
{
    public function donors(){
        return $this->belongsTo('App\Models\Donor', 'donor_id');
    }

    public function centers(){
        return $this->belongsTo('App\Models\Center', 'center_id');
    }
    use HasFactory;
}
