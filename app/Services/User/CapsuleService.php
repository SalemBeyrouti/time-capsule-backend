<?php

namespace App\Services\User;

use App\Models\Capsule;

class CapsuleService
{
    /**
     * Create a new class instance.
     */
    public static function getAllCapsules($id = null)
    {
        if (!$id) {
            return Capsule::all();
        }
        return Capsule::find($id);
        
    }

    public static function getUserCapsules($userId) {
        return Capsule::where('user_id', $userId)->get();
    }

    static function createOrUpdateCapsule($data, $capsule, $user){
        $capsule->user_id = $capsule->user_id ?? $user->id;
        $capsule->title = $data["title"] ?? $capsule->title;
        $capsule->message = $data["message"] ?? $capsule->message;
        $capsule->revealed_at = $data['revealed_at'] ?? $capsule->revealed_at;
        $capsule->is_surprise = $data['is_surprise'] ?? $capsule->is_surprise;
        $capsule->emoji = $data['emoji'] ?? $capsule->emoji;
        $capsule->color = $data['color'] ?? $capsule->color;
        $capsule->cover_image_url = $data['cover_image_url'] ?? $capsule->cover_image_url;
        $capsule->save();

        return $capsule;

    }
}
