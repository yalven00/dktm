<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ManagersController;
use App\Http\Controllers\EmployersController;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(
 [ 'prefix' => 'manager',
   'namespace' => 'manager',
   'middleware' => 'manager'
 ], function() {

  Route::get('profile_manager', [ManagersController::class, 'profile'])->name('profile_manager');
  Route::get('create_employer', [ManagersController::class, 'create_employer'])->name('create_employer');
  Route::get('my_employers_notes', [ManagersController::class, 'my_employers_notes'])->name('my_employers_notes');
  Route::post('add_employer', [ManagersController::class, 'add_employer'])->name('add_employer');

});

Route::group(
 [ 'prefix' => 'employer',
   'namespace' => 'employer',
   'middleware' => 'employer'
 ], function() {

  Route::get('profile_employer', [EmployersController::class, 'profile'])->name('profile_employer');
  Route::get('create_note', [EmployersController::class, 'create_note'])->name('create_note');
  Route::get('add_note', [EmployersController::class, 'add_note'])->name('add_note');
  Route::post('get_my_notes', [EmployersController::class, 'get_my_notes'])->name('get_my_notes');

});