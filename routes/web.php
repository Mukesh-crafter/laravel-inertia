<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
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

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->name('dashboard');

Route::middleware(['auth:sanctum', 'verified'])->get('/posts', function () {
    return Inertia::render('Posts/Posts');
})->name('posts');

Route::middleware(['auth:sanctum', 'verified'])->get('posts/create', function () {
    return Inertia::render('Posts/Create');
})->name('create');

Route::middleware(['auth:sanctum', 'verified'])->get('posts/{post}/edit', function () {
    return Inertia::render('Posts/Edit');
})->name('edit');

Route::resource('posts', PostController::class);

Route::post('/posts', [PostController::class, 'store']);

Route::put('posts/{post}', [PostController::class, 'update']);

Route::delete('posts/{post}', [PostController::class, 'destroy'])->name('posts.destroy');