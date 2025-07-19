<?php

namespace App\Http\Controllers\User;

use App\Models\Capsule;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\User\CapsuleService;


class CapsuleController extends Controller
{
    function getAllCapsules(){
        $capsules = CapsuleService::getAllCapsules();
        return $this->responseJSON($capsules);

    }

    function addOrUpdateCapsule(Request $request, $id = null) {
        $capsule = new Capsule;
        if($id) {
            $capsule = CapsuleService::getAllCapsules($id);

            if(!$capsule) {
                return $this->responseJSON("capsule not found", 404 );
            }
        }

        $capsule = CapsuleService::createOrUpdateCapsule($request->all(), $capsule);
        return $this->responseJSON($capsule);
    }
}
