<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\QuestController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\createGroup;
use App\Http\Controllers\groups;
use App\Http\Controllers\DashboardController;
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
    Route::get('/logout', [LoginController::class, 'destroy'])->name('logout.get');

    
Route::get('/quests/create', [QuestController::class, 'create'])->name('quest.create');


    Route::post('/quests/create/{group?}',[QuestController::class, 'store'])->name('quest.store');
    Route::get('show/{id}',[QuestController::class, 'show'])->name('quest.show');

    Route::get('edit/{id}',[QuestController::class, 'edit'])->name('quest.edit');
Route::put('update/{quest}', [QuestController::class, 'update'])->name('quest.update');

Route::delete('destroy/{id}', [QuestController::class, 'destroy'])->name('quest.destroy');


    Route::get('/groups', [groups::class, 'create'])->name('groups');
Route::get('/createGroup', [createGroup::class, 'create'])->name('createGroup');
Route::post('/createGroup/register', [createGroup::class, 'storeReg'])->name('storeReg');
Route::post('/createGroup/login', [createGroup::class, 'storeLog'])->name('storeLog');
Route::get('/quests/group/{group}', [QuestController::class, 'index'])->name('quest.index');


Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

});