<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\User\CapsuleService;

class PublicWallController extends Controller
{
    public function index(Request $request) {
        $filters = $request->only(['country', 'mood', 'start_date', 'end_date']);
        $capsules = CapsuleService::getPublicWallCapsules($filters);

        return $this->responseJSON($capsules);
    }
}
