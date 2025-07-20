<?php

namespace App\Services\User;

use App\Models\Tag;
use App\Models\Capsule;


class CapsuleService
{
    /**
     * Create a new class instance.
     */
    public static function getAllCapsules($id = null)
    {
        if (!$id) {
            return Capsule::with(['tags', 'media', 'location'])->get();
        }
        return Capsule::with(['tags', 'media', 'location']) -> find($id);
        
    }

    public static function getUserCapsules($userId) {
       return Capsule::with(['tags', 'media', 'location'])
        ->where('user_id', $userId)
        ->orderBy('created_at', 'desc') ->get();
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

        if(isset($data['tags']) && is_array($data['tags'])) {
            $tagIds = [];

            foreach ($data['tags'] as $tagName) {
                $tag = Tag::firstOrCreate(['name' => $tagName]);
                $tagIds[] = $tag->id;
            }
            $capsule->tags()->sync($tagIds);
        }

        return Capsule::with('tags')->find($capsule->id);

    }
}
