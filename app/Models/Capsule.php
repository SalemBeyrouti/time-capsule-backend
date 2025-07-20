<?php

namespace App\Models;

use App\Models\Tag;
use App\Models\Location;
use App\Traits\PreviewTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Capsule extends Model
{
    /** @use HasFactory<\Database\Factories\CapsuleFactory> */
    use HasFactory, PreviewTrait;
    public function location(){
        return $this->hasOne(Location::class);
    }

    public function media(){
        return $this->hasMany(Media::class);
    }

    public function tags() {
        return $this->belongsToMany(Tag::class, 'capsule_tag');
    }

    public function user() {
        return $this->belongsTo(User::class);
    }
}
