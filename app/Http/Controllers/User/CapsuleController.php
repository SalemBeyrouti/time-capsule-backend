<?php

namespace App\Http\Controllers\User;

use App\Models\Capsule;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\User\CapsuleService;
use Illuminate\Support\Facades\Auth;


class CapsuleController extends Controller
{

   
    function getAllCapsules(){
        $capsules = CapsuleService::getAllCapsules();
        return $this->responseJSON($capsules);

    }

    function getMyCapsules(){
        $user = Auth::user();
        if(!$user) {
            return $this->responseJSON("unauthroized", 401);
        }

        $capsules = CapsuleService::getUserCapsules($user->id);
        return $this->responseJSON($capsules);
    }

    function getCapsuleById($id){
        $capsule = CapsuleService::getAllCapsules($id);

        if(!$capsule){
            return $this->responseJSON("capsule not found", 404);
        }
        return $this->responseJSON($capsule);
    }

    function addOrUpdateCapsule(Request $request, $id = null) {
         $user = Auth::user();
         if (!$user)  {
             return $this->responseJSON("unauthorized", 401);
    }
        $capsule = new Capsule;
        if($id) {
            $capsule = CapsuleService::getAllCapsules($id);

            if(!$capsule) {
                return $this->responseJSON("capsule not found", 404 );
            }
        }

        $capsule = CapsuleService::createOrUpdateCapsule($request->all(), $capsule, $user);
        return $this->responseJSON($capsule);
    }

    function getPrivateCapsules() {
        $user = Auth::user();
        if(!$user) {
            return $this->responseJSON("unauthorized", 404);
        }
        $capsules = CapsuleService::getPrivateUserCapsule($user->id, 'private');
        return $this->responseJSON($capsules);
    }
}
