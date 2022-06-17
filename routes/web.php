<?php

use App\Http\Controllers\payments\pesapal\PesaPalController;
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

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/donate', function () {
    return Inertia::render('Donate');
})->middleware(['auth', 'verified'])->name('donate');

Route::get('/transaction', function () {
    return Inertia::render('Transaction');
})->middleware(['auth', 'verified'])->name('transaction');

Route::get('/pesapal', function () {
    return Inertia::render('Merchant');
})->middleware(['auth', 'verified'])->name('pesapal');


Route::post('/get-token', [PesaPalController::class, 'getAccessToken']);
Route::post('/lipa', [PesaPalController::class, 'requestLipaNaPesaPal']);

require __DIR__.'/auth.php';
