<?php

use App\Http\Controllers\API\BlogAPIController;
use App\Http\Controllers\API\CategorieAPIController;
use App\Http\Controllers\API\ClientAPIController;
use App\Http\Controllers\API\ContactAPIController;
use App\Http\Controllers\API\LivreAPIController;
use App\Http\Controllers\API\PAYAPIController;
use App\Http\Controllers\API\StatistiqueAPIController;
use App\Http\Controllers\API\TauxAPIController;
use App\Models\Categorieblog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::resource('contact', ContactAPIController::class);

Route::group(['middleware' => ['auth:sanctum']], function () {

    Route::any('stat', [StatistiqueAPIController::class, 'index'])->name('stat');
    Route::resource('taux', TauxAPIController::class);
    Route::resource('clients', ClientAPIController::class);
    Route::resource('blog', BlogAPIController::class);
    Route::resource('categorie', CategorieAPIController::class);
    Route::resource('livre', LivreAPIController::class)->only(['index', 'store', 'destroy']);
    Route::post('livre/{livre}', [LivreAPIController::class, 'update'])->name('livre.update');

    Route::get('pay/val', [PAYAPIController::class, 'subscribeval'])->name('subscribeval');
    Route::post('/pay/init', [PAYAPIController::class, 'init_payment'])->name('api.init.pay');
    Route::get('/pay/check', [PAYAPIController::class, 'check_payment'])->name('api.check.pay');
});
