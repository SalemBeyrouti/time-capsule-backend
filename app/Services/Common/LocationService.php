<?php

namespace App\Services\Common;

use App\Models\Capsule;
use App\Models\Location;
use Illuminate\Http\Request;
use Stevebauman\Location\Facades\Location as IpLocator;

class LocationService
{
    static function storeOrUpdate(Request $request){
        $request->validate([
            'capsule_id'=>'required|exists:capsules,id',
            'ip_address'=> 'required|ip'
        ]);
        $user = $request->user();

        $capsule = Capsule::where('id', $request->capsule_id)
        -> where('user_id', $user->id)
        ->first();

        if(!$capsule)
            return null;

        $position = IpLocator::get($request->ip_address);
        if(!$position)
            return null;

        return Location::updateOrCreate(
            ['capsule_id' => $capsule->id], [
                'ip_address' => $request->ip_address,
                'latitude'   => $position->latitude,
                'longitude'  => $position->longitude,
                'city'       => $position->cityName,
                'country'    => $position->countryName,
            ]
            );     
    }

    static function getCapsulesByCountry(string $country) {
        return Capsule::where('visibility', 'public')
        ->whereIn('id', function ($query) use ($country) {
            $query->select('capsule_id') -> from('locations') -> where('country', $country);
        })
        ->with ('location') ->latest() -> get();
    }
}
