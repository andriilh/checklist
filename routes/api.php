<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ChecklistController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::group(['middleware' => 'api'], function ($router) {
    Route::post('register', [AuthController::class, 'register']);
    Route::post('login', [AuthController::class, 'login']);

    Route::middleware(['auth'])->group(function () {
        Route::get('checklist', [ChecklistController::class, 'index']);
        Route::post('checklist', [ChecklistController::class, 'store']);
        Route::delete('checklist/{checklistId}', [ChecklistController::class, 'destroy']);

        Route::get('checklist/{checklistId}/item', [ChecklistController::class, 'item']);
        Route::post('checklist/{checklistId}/item', [ChecklistController::class, 'newItem']);
        Route::get('checklist/{checklistId}/item/{checklistItemId}', [ChecklistController::class, 'getCheklistItem']);
        Route::put('checklist/{checklistId}/item/{checklistItemId}', [ChecklistController::class, 'updateCheklistItem']);
        Route::delete('checklist/{checklistId}/item/{checklistItemId}', [ChecklistController::class, 'deleteCheklistItem']);
    });
});
