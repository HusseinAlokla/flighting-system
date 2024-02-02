<?php

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
// routes/web.php

use App\Http\Controllers\UserController;

Route::get('/delete-user/{userId}', [UserController::class, 'deleteUser']);
Route::resource('users', UserController::class);

// Add User
Route::post('/users', [UserController::class, 'store'])->name('users.store');

// Update User
Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');

// Delete User
Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');

