<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\QuestController;
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

Route::view('/', 'welcome')->name('welcome');

Route::middleware('guest')->group(function () {
    Route::view('/reg-log', 'auth.reg-log');

    Route::get('/register', [RegisterController::class, 'create'])->name('register');
    Route::post('/register', [RegisterController::class, 'store']);

    Route::get('/login', [LoginController::class, 'create'])->name('login');
    Route::post('/login', [LoginController::class, 'store']);

});


Route::middleware('auth')->group(function () {
     Route::post('/logout', [LoginController::class, 'destroy'])->name('logout');

    Route::get('index',[QuestController::class, 'index'])->name('quest.index');
    
    Route::get('create',[QuestController::class, 'create'])->name('quest.create');
    Route::post('create',[QuestController::class, 'store'])->name('quest.store');
    Route::get('show/{id}',[QuestController::class, 'show'])->name('quest.show');

    Route::get('{id}/edit',[QuestController::class, 'edit'])->name('quest.edit');
    Route::put('update',[QuestController::class, 'update'])->name('quest.update');
    Route::delete('destroy',[QuestController::class, 'destroy'])->name('quest.destroy');
});