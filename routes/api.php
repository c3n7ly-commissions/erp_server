<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Company\DivisionController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
// return $request->user();
// });
//

Route::group(['middleware' => ['auth:sanctum']], function () {
  Route::post('auth/logout', [AuthController::class, 'logout'])->name('auth.logout');

  Route::resource('divisions', DivisionController::class)->except([
    "create", "edit"
  ]);
});

Route::post('auth/register', [AuthController::class, 'register'])->name('auth.register');
Route::post('auth/login', [AuthController::class, 'login'])->name('auth.login');
