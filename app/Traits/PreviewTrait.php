<?php

namespace App\Traits;

trait PreviewTrait
{
    public function formatCapsulePreview () {

        return [
            'id' => $this->id,
            'title' => $this->title,
            'emoji' => $this->emoji,
            'color' => $this->color,
            'cover_image_url' => $this->cover_image_url,
            'revealed_at' => $this->revealed_at,
            'country' => $this->country ?? null,
            'message' => $this->message,
            'privacy' => $this->visibility,
            'user' => [
                'name' => $this->user->name,
                'profile_image_url' => $this->user->profile_image_url ?? null,
            ],
            'tags' => $this->tags->pluck('name')->toArray(),
            'media' => $this->media->map(function ($item) {
                return [
                    'type' => $item->type,
                    'url' => $item->url,
                    'content' => $item->content,
                ];
            })

        ];
    }
}
