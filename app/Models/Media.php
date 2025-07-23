<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Media extends Model
{

    protected $fillable = [
    'capsule_id',
    'type',
    'purpose',
    'url',
    'content',
];
    public function capsule() {
        return $this->belongsTo(Capsule::class);
    }

    
}

