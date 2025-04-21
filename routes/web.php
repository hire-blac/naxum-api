<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminControllers;
use Illuminate\Support\Facades\Route;

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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Route::middleware(['auth', 'role:admin'])->group(function () {
Route::middleware(['auth'])->group(function () {
  Route::get('/admin', [AdminControllers::class, 'index'])->name('admin.dashboard');
  Route::get('/admin/users', [AdminControllers::class, 'users'])->name('admin.users');
  Route::post('/admin/users', [AdminControllers::class, 'createUser'])->name('admin.users.create');
});

require __DIR__.'/auth.php';
