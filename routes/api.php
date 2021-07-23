<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Company\BranchController;
use App\Http\Controllers\Company\BranchProductLevelController;
use App\Http\Controllers\Company\DivisionBranchController;
use App\Http\Controllers\Company\DivisionController;
use App\Http\Controllers\Company\DivisionProductController;
use App\Http\Controllers\Company\Partners\Supplier\DivisionSupplierController;
use App\Http\Controllers\Partners\Supplier\SupplierController;
use App\Http\Controllers\Product\CategoryController;
use App\Http\Controllers\Product\ProductController;
use App\Http\Controllers\Product\ProductLevelController;
use App\Http\Controllers\Product\SubCategoryController;
use App\Http\Controllers\Product\TaxController;
use App\Http\Controllers\Product\UnitController;
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

  // =================================================================
  // company
  // -----------------------------------------------------------------
  Route::resource('divisions', DivisionController::class)->except([
    "create", "edit"
  ]);

  Route::resource('branches', BranchController::class)->only([
    "index", "show"
  ]);

  Route::resource('branches.product_levels', BranchProductLevelController::class)->except([
    "create",  "show", "edit"
  ]);

  Route::resource('divisions.branches', DivisionBranchController::class)->except([
    "create",  "show", "edit"
  ]);

  Route::resource('divisions.products', DivisionProductController::class)->except([
    "create",  "show", "edit"
  ]);
  // -----------------------------------------------------------------
  // =================================================================


  // =================================================================
  // products
  // -----------------------------------------------------------------
  Route::resource('categories', CategoryController::class)->except([
    "create", "edit"
  ]);

  Route::resource('subcategories', SubCategoryController::class)->except([
    "create", "edit"
  ]);

  Route::resource('units', UnitController::class)->except([
    "create", "edit"
  ]);

  Route::resource('taxes', TaxController::class)->except([
    "create", "edit"
  ]);

  Route::resource('products', ProductController::class)->only([
    "index", "show"
  ]);

  Route::resource('product_levels', ProductLevelController::class)->only([
    "index", "show"
  ]);

  // =================================================================
  // partners
  // -----------------------------------------------------------------
  Route::resource('suppliers', SupplierController::class)->except([
    "create", "edit"
  ]);

  Route::resource('division_suppliers', DivisionSupplierController::class)->only([
    "index", "show"
  ]);
});

Route::post('auth/register', [AuthController::class, 'register'])->name('auth.register');
Route::post('auth/login', [AuthController::class, 'login'])->name('auth.login');
