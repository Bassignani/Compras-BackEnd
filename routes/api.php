<?php


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


use App\Http\Controllers\UserController;



Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

    //USER ROUTES
Route::post('register', [UserController::class, 'register']);
Route::post('login', [UserController::class, 'login']);
// Route::group(['middleware' => ["auth"]], function(){
//     Route::get('users-profile', [UserController::class, 'userProfile']);
//     Route::get('logout', [UserController::class, 'logout']);
// });


Route::middleware('auth:sanctum')->group( function () {
    Route::get('users-profile', [UserController::class, 'userProfile']);
    Route::get('logout', [UserController::class, 'logout']);
    Route::get('users', [UserController::class, 'index']);
});


