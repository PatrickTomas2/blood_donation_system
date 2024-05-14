<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DonorActiveStatus extends Model
{
    public function donor(){
        return $this->belongsTo('App\Models\Donor', 'donor_id');
    }
    
    use HasFactory;
}
