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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Route::prefix('admin')->middleware(['auth', 'can:is-admin'])->group(function () {
Route::prefix('admin')->middleware(['auth'])->group(function () {
  Route::get('/users', [AdminControllers::class, 'users'])->name('admin.users');
  Route::get('/users/create', [AdminControllers::class, 'createUserForm'])->name('admin.users.create');
  Route::post('/users', [AdminControllers::class, 'storeUser'])->name('admin.users.store');
  Route::get('/users/{user}/edit', [AdminControllers::class, 'editUserForm'])->name('admin.users.edit');
  Route::put('/users/{user}', [AdminControllers::class, 'updateUser'])->name('admin.users.update');
  Route::delete('/users/{user}', [AdminControllers::class, 'deleteUser'])->name('admin.users.delete');
});

require __DIR__.'/auth.php';
