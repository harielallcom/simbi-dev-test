<?php

use App\Http\Controllers\CreateAuthorController;
use App\Http\Controllers\CreateBookController;
use App\Http\Controllers\CreateLoanController;
use App\Http\Controllers\ListAllBooksController;
use App\Http\Controllers\ListBooksByAuthorController;
use App\Http\Controllers\UpdateAuthorController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(["prefix" => "books"], function () {
    Route::post("", CreateBookController::class);
    Route::get("", ListAllBooksController::class);
});

Route::group(["prefix" => "authors"], function () {
    Route::get("{id}/books", ListBooksByAuthorController::class);
    Route::post("", CreateAuthorController::class);
    Route::put("{id}", UpdateAuthorController::class);
});

Route::group(["prefix" => "loans"], function () {
    Route::post("", CreateLoanController::class);
    // Route::put("{id}/return", ReturnLoanController::class);
    // Route::get("", ListLoansController::class);
});

Route::middleware("auth:sanctum")->get("/user", function (Request $request) {
    return $request->user();
});
