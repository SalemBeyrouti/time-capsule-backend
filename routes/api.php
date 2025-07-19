<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\CapsuleController;

Route::get("/capsules", [CapsuleController::class, "getAllCapsules"]);

Route::get('/', [CapsuleController::class, 'store']);
Route::post("/add_update_capsule/{id}", [CapsuleController::class, "addOrUpdateCapsule"]);
Route::post('/add_update_capsule', [CapsuleController::class, 'addOrUpdateCapsule']);


// Route::group(["prefix" => "guest"], function(){
//         Route::post("/login", [AuthController::class, "login"]);
//         Route::post("/register", [AuthController::class, "register"]);
//     });
// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');
