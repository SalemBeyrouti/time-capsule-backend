<?php


namespace App\Services\User;

use App\Models\Media;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class MediaService
{
    public  function storeMediaForCapsule(Request $request, $capsuleId)
    {
        $validated = $request->validate([
            'type'       => 'required|in:image,audio,text,markdown',
            'data'       => 'required|string',
        ]);

        $validated['capsule_id'] = $capsuleId;

        return match ($validated['type']) {
            'image' => $this->storeImage($validated),
            'audio' => $this->storeAudio($validated),
            default => $this->storeText($validated),
        };
    }

    private function storeImage(array $data)
    {
        $fileName = 'images/' . Str::uuid() . '.png';
        Storage::disk('public')->put($fileName, base64_decode($data['data']));

        return Media::create([
            'capsule_id' => $data['capsule_id'],
            'type'       => 'image',
            'url'        => Storage::url($fileName),
        ]);
    }

    private function storeAudio(array $data)
    {
        $fileName = 'audio/' . Str::uuid() . '.mp3';
        Storage::disk('public')->put($fileName, base64_decode($data['data']));

        return Media::create([
            'capsule_id' => $data['capsule_id'],
            'type'       => 'audio',
            'url'        => Storage::url($fileName),
        ]);
    }

    private function storeText(array $data)
    {
        return Media::create([
            'capsule_id' => $data['capsule_id'],
            'type'       => $data['type'],
            'content'    => $data['data'],
        ]);
    }

    static function getMediaForCapsule(int $capsuleId) {
        return Media::where('capsule_id', $capsuleId) -> select ('id', 'type', 'url', 'content', 'created_at') -> orderBy('created_at', 'asc') -> get();
    }
}
