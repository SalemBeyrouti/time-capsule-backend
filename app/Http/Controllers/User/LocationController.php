<?php

namespace App\Http\Controllers\User;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Common\LocationService;

class LocationController extends Controller
{
    public function store(Request $request){
        
        $location = LocationService::storeOrUpdate($request);

        if (!$location) {
            return $this->responseJSON(null, "couldnt resolve location",402 );
        }

        return $this->responseJSON($location, "Location saved successfully", 200);

    }

    public function getByCountry($country) {
        $capsules = LocationService::getCapsulesByCountry($country);
        return  $this->responseJSON($capsules);
    }
}
