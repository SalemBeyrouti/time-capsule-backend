<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    protected $fillable = [
    'capsule_id',
    'ip_address',
    'latitude',
    'longitude',
    'city',
    'country',
];
}
