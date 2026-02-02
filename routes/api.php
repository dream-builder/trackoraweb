<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LocationManager;
use App\Http\Controllers\RedisManagerController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/getlivelocation', [LocationManager::class, 'getlivelocation'])->name('locationmanager');
Route::get('/savelivelocation', [LocationManager::class, 'savelivelocation']);
Route::get('/getrouteinfo', [LocationManager::class, 'getrouteinfo']);


Route::post('/location/store', [RedisManagerController::class, 'setUserLocation']);
Route::get('/location/{user_id}', [RedisManagerController::class, 'getUserLocation']);



