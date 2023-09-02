<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\InicioController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::middleware('auth')->group(function () {
    Route::get('/', [InicioController::class, "index"])->name('index');
    Route::post('/store', [InicioController::class, "store"])->name('store');
    Route::post('/update/{id}', [InicioController::class, "update"])->name('update');
    Route::get('/delete/{id}', [InicioController::class, "destroy"])->name('delete');

});


/*
Route::get('/', function () {
    return view('auth.login');
});
*/
