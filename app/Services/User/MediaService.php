<?php


namespace App\Services\User;

use App\Models\Media;
use App\Models\Capsule;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MediaService
{
    public  function storeMediaForCapsule(Request $request, $capsuleId)
    {
        $validated = $request->validate([
            'type'       => 'required|in:image,audio,text,markdown',
            'data' => 'required|string',
            'purpose' => 'nullable|string', 
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
        $raw = $data['data'];

        if (preg_match('/^data:image\/(\w+);base64,/', $raw, $matches)) {
            $raw = substr($raw, strpos($raw, ',') + 1);
            $extension = $matches[1];
        } else {
            $extension = 'png';
        }

        $decoded = base64_decode($raw);

        if ($decoded === false) {
            throw new \Exception('Invalid base64 image data.');
        }

        $fileName = 'images/' . Str::uuid() . '.' . $extension;
        $publicUrl = Storage::url($fileName);
        Storage::disk('public')->put($fileName, $decoded);

         $media = Media::create([
            'capsule_id' => $data['capsule_id'],
            'type' => 'image',
            'purpose' => $data['purpose'] ?? null,
            'url' => Storage::url($fileName),
        ]);

        $capsule = Capsule::find($data['capsule_id']);
        if ($capsule && ($data['purpose'] ?? null) === 'background') {
            $capsule->cover_image_url = $publicUrl;
            $capsule->save();
        }
        return $media;
    }

    private function storeAudio(array $data)
    {
        $fileName = 'audio/' . Str::uuid() . '.mp3';
        Storage::disk('public')->put($fileName, base64_decode($data['data']));

        return Media::create([
            'capsule_id' => $data['capsule_id'],
            'purpose' => $data['purpose'] ?? null,
            'type'       => 'audio',
            'url'        => Storage::url($fileName),
        ]);
    }

    private function storeText(array $data)
    {
        return Media::create([
            'capsule_id' => $data['capsule_id'],
            'type'       => $data['type'],
            'purpose' => $data['purpose'] ?? null,
            'content'    => $data['data'],
        ]);
    }

    static function getMediaForCapsule(int $capsuleId) {
        return Media::where('capsule_id', $capsuleId) -> select ('id', 'type', 'purpose', 'url', 'content', 'created_at') -> orderBy('created_at', 'asc') -> get();
    }

    
}
