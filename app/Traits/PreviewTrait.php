<?php

namespace App\Traits;

trait PreviewTrait
{
    public function formatCapsulePreview () {

        return [
            'id' => $this->id,
            'title' => $this->title,
            'emoji' => $this->emoji,
            'cover_image_url' => $this->cover_image_url,
            'revealed_at' => $this->revealed_at,
            'country' => $this->country ?? null,
            'user' => [
                'name' => $this->user->name,
                'profile_image_url' => $this->user->profile_image_url ?? null,
            ],
            'tags' => $this->tags->pluck('name')->toArray()

        ];
    }
}
