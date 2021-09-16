<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\registerController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AnnonceController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
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

Route::get("/register", [RegisterController::class, "create"]);
Route::post("register", [RegisterController::class, "store"]);
Route::get("/home", [AnnonceController::class, "showIndex"])->middleware('auth');;
Route::get("/annonces", [AnnonceController::class, "index"]);
Route::get("/create-annonce", [AnnonceController::class, "create"]);
Route::post("create-annonce", [AnnonceController::class, "store"]);
Route::get("/change-annonce/{annonce}", [AnnonceController::class, "edit"]);
Route::post("change-annonce/{annonce}", [AnnonceController::class, "update"]);
Route::get("/delete/{annonce}", [AnnonceController::class, "preview"]);
Route::post("/delete/{annonce}", [AnnonceController::class, "delete"]);
Route::get("/delete-this/{annonce}", [AnnonceController::class, "destroy"]);
Route::get("/login", [LoginController::class, "link"]);
Route::post("login", [LoginController::class, "authenticate"]);
Route::post("logout", [LoginController::class, "logout"])->name('logout');;
Route::get("/change", [LoginController::class, "indexUpdate"]);
Route::post("change", [LoginController::class, "update"])->name("update");


Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
    return redirect('/home');
})->middleware(['auth', 'signed'])->name('verification.verify');
