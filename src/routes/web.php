<?php

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

use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ExportController;

Route::middleware('auth')->group(function () {
    Route::get('/admin', [AuthController::class, 'admin']);
});
Route::post('/logout', [AuthController::class, 'destroy']);
Route::get('/admin/contact/{id}', [AuthController::class, 'show'])->name('admin.contact.detail');
Route::get('/admin/search', [AuthController::class, 'search']);
Route::delete('/admin/delete', [AdminController::class, 'destroy'])->name('admin.contact.delete');
Route::get('/', [ContactController::class, 'index']);
Route::get('/thanks', [ContactController::class, 'show']);
Route::post('/confirm', [ContactController::class, 'confirm']);
Route::post('/contacts', [ContactController::class, 'store']);
Route::get('/admin/export', [ExportController::class, 'export']);
