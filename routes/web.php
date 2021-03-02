<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware(['auth', 'verified'])->group(function() {
    Route::get('/dashboard', \App\Http\Controllers\DashboardController::class . "@index")->name('dashboard');
    Route::get("todos", \App\Http\Controllers\TodoController::class . "@index")->name("todos.index");
    Route::post("todos", \App\Http\Controllers\TodoController::class . "@store")->name("todos.store");
    Route::patch("todos/{todo}/done", \App\Http\Controllers\TodoController::class . "@done")->name("todos.done");
});

require __DIR__.'/auth.php';
