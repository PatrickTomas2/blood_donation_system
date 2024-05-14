<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DonationDrive extends Model
{
    protected $fillable = [
        'admin_id',
        'establishment_name',
        'address',
        'start_time',
        'end_time',
        'phone',
        'status',
        'date'
    ];

    public function admin(){
        return $this->belongsTo('App\Models\Admin', 'admin_id');
    }
    use HasFactory;
}
