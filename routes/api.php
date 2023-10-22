<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\FreelanceController;
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

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware(['auth:sanctum'])->group(function(){

    Route::get('/getUser',[AuthController::class,'getUser'])->name('getUser');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logoutUser')->middleware('auth:sanctum');

    Route::post('/storeFreelance',[FreelanceController::class, 'storeFreelance'])->name('storeFreelance');
});

Route::post('/login',[AuthController::class, 'auth'])->name('loginToken');


Route::post('/register', [AuthController::class, 'register'])->name('registerToken');



Route::get('/getAllFreelance', [FreelanceController::class, 'getAllFreelance'])->name('getAllFreelance');


Route::controller(CategoryController::class)->group(function () {
   // Route::get('/api/subcategoriesAll', 'subcategoriesAll')->name('subcategoriesAll');
    Route::get('/getAllCategories',  'getAllCategories')->name('getAllCategories');
    Route::get('/subcategoriesByname/{category}', 'subcategoriesByname')->name('subcategoriesByname');
    Route::get('/subcategories/{categoryId}', 'getByCategoryId')->name('fetchAllSubCategory');
    Route::get('/getServices/{category}', 'fetchAllServicesByCategory')->name('fetchAllServices');
    Route::get('/oneService/{service}','fetchOneService')->name('oneService');
});
