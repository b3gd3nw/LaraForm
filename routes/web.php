<?php

use App\Http\Controllers\Admin\MembersController;
use App\Http\Controllers\MemberController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


//Route::get('token', [MemberController::class, 'getCSRF']);
//
//Route::get('/', function () {
//    return view('index');
//});



Route::prefix('/api')->group(function (){
    Auth::routes();
    Route::resource('submit', MemberController::class);

    Route::group(['middleware' => 'auth'], function () {
//    Route::middleware('auth:api')->group(function (){
        Route::middleware(['role:admin'])->prefix('admin_panel')->group(function () {
            Route::get('/', [App\Http\Controllers\Admin\HomeController::class, 'index'])->name('homeAdmin');

            Route::resource('member', MembersController::class);
        });
    });


});
Route::get('/{any}', function () {
    return view('index');
})->where('any', '.*');





