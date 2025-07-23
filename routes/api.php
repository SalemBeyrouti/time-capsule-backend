<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\MediaController;
use App\Http\Controllers\Common\AuthController;
use App\Http\Controllers\User\CapsuleController;
use App\Http\Controllers\User\LocationController;
use App\Http\Controllers\User\PublicWallController;
use App\Http\Controllers\User\CapsuleExportController;



Route::group(["prefix" => "v0.1"], function () {
    Route::group(["prefix" => "guest"], function () {
        Route::post('/register', [AuthController::class, 'register']);
        Route::post('/login', [AuthController::class, 'login']);
    });

    Route::group(["middleware" => "auth:api"], function () {
    Route::group(["prefix" => "user"], function () {
        Route::get("/capsules", [CapsuleController::class, "getAllCapsules"]);
        Route::get('/capsules/{id}', [CapsuleController::class, 'getCapsuleById']);
        Route::post("/add_update_capsule/{id?}", [CapsuleController::class, "addOrUpdateCapsule"]);
        Route::get('/mycapsules', [CapsuleController::class, 'getMyCapsules']);
        Route::post('/locations', [LocationController::class, 'store']);
        Route::get('/capsules/by-country/{country}', [LocationController::class, 'getByCountry']);
        Route::get('/public-wall/countries', [LocationController::class, 'getAvailableCountries']);
        Route::post('/capsules/{id}/media', [MediaController::class, 'storeMedia']);
        Route::get('/capsule/{capsuleId}/media', [MediaController::class, 'getMedia']);
        Route::get('/public-wall', [PublicWallController::class, 'index']);
        Route::get('/public-wall/moods', [PublicWallController::class, 'moods']);
        Route::get('/capsules/{id}/export', [CapsuleExportController::class, 'downloadCapsuleZip']);




    });
});



});


