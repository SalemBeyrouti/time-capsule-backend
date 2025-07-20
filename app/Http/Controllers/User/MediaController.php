<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\User\MediaService;

class MediaController extends Controller
{
    function storeMedia(Request $request, $id) {
        $media = (new MediaService)->storeMediaForCapsule($request, $id);

        return $this->responseJSON($media, 'Media stored successfully');
    }

    function getMedia($capsuleId) {
        $media = MediaService::getMediaForCapsule($capsuleId);
        return $this->responseJSON($media, 'Media retrieved successfully');
    }
}
