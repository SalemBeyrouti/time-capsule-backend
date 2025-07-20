<?php

namespace App\Models;
use App\Models\Location;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Capsule extends Model
{
    /** @use HasFactory<\Database\Factories\CapsuleFactory> */
    use HasFactory;
    public function location(){
        return $this->hasOne(Location::class);
    }

    public function media(){
        return $this->hasMany(Media::class);
    }
}
