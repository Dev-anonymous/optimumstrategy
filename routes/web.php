<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\WEBController;
use Illuminate\Support\Facades\Route;

Route::get('', [WEBController::class, 'home'])->name('home');
Route::get('login', [WEBController::class, 'loginview'])->name('login');
Route::get('blog', [WEBController::class, 'blog'])->name('blog');

Route::post('/auth/login', [AuthController::class, 'login'])->name('web.login');
Route::post('/auth/signup', [AuthController::class, 'signup'])->name('web.signup');

Route::middleware('auth')->group(function () {
    Route::post('/auth/logout', [AuthController::class, 'logout'])->name('web.logout');

    Route::prefix('my-dash')->group(function () {
        Route::get('', [AdminController::class, 'index'])->name('admin.home');
        Route::get('clients', [AdminController::class, 'clients'])->name('admin.client');
        Route::get('contact', [AdminController::class, 'contact'])->name('admin.contact');
        Route::get('blog', [AdminController::class, 'blog'])->name('admin.blog');
        Route::get('categorie', [AdminController::class, 'categorie'])->name('admin.categorie');
        Route::get('taux', [AdminController::class, 'taux'])->name('admin.taux');
        Route::get('commandes', [AdminController::class, 'commande'])->name('admin.commande');
        Route::get('livres', [AdminController::class, 'livres'])->name('admin.livre');
    });

    Route::get('blogdl', [WEBController::class, 'blogdl'])->name('blogdl');
});
