<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Participan extends Model
{
    use HasFactory;
    protected $table = 'presensi'; // 
    protected $primaryKey = 'id';
    protected $fillable=[
        'user_id',
        'name',
        'checkin_time',
        'checkout_time',
        'date',
        'status',
        'reason',
        'location_in',
        'location_out',
        'image_in',
        'image_out',
    ];
}
