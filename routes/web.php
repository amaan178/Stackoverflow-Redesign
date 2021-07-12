<?php

use App\Http\Controllers\AnswersController;
use App\Http\Controllers\FavoritesController;
use App\Http\Controllers\QuestionsController;
use Illuminate\Support\Facades\Auth;
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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::resource('questions', QuestionsController::class)->except('show');
Route::get('questions/{slug}', [QuestionsController::class, 'show'])->name('questions.show');
Route::resource('questions.answers', AnswersController::class)->except('index', 'show', 'create');
Route::put('answers/{answer}/best-answer',[AnswersController::class, 'bestAnswer'])->name('answers.bestAnswer');
Route::post('questions/{question}/favorite', [FavoritesController::class, 'store'])->name('questions.favorite');
Route::post('questions/{question}/unfavorite', [FavoritesController::class, 'destroy'])->name('questions.unfavorite');
