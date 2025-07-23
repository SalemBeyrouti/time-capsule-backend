<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\User\CapsuleService;
use App\Services\Common\LocationService;

class PublicWallController extends Controller
{
    public function index(Request $request) {
        $filters = $request->only(['country', 'mood', 'start_date', 'end_date']);
        $perPage = $request->get('per_page', 9);
        $capsules = CapsuleService::getPublicWallCapsules($filters, $perPage);

        return $this->responseJSON($capsules);
    }

    public function countries() {
        $countries = LocationService::getAvailableCountries();
        return $this->responseJSON($countries);
    }

    public function moods() {
        $moods = CapsuleService::getAvailableMoods();
        return $this->responseJSON($moods);
    }
}
