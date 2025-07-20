<?php

namespace App\Models;

use App\Models\Capsule;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Tag extends Model
{
    use HasFactory;
    
    protected $fillable=['name'];

    function capsules() {
        return $this->belongsToMany(Capsule::class, 'capsule_tag');
    }
}
