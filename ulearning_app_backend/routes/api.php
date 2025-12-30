 <?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\CourseController;
use App\Http\Controllers\Api\PayController;

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

Route::group(['namespace'=>'App\Http\Controllers\Api'], function(){
    Route::post('register', [UserController::class, 'createUser']);
    Route::post('login', [UserController::class, 'loginUser']);
    
    Route::group(['middleware' => ['auth:sanctum']], function(){
        Route::any('courseList', [CourseController::class, 'courseList']);
        Route::any('coureDetail', [CourseController::class, 'courseDetail']);
        Route::any('checkout', [PayController::class,'checkout']);
    });
});

