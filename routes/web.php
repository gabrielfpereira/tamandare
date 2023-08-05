<?php

use App\Http\Controllers\{ProfileController, RecordController, StudentController};
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    if(app()->isLocal()) {
        auth()->loginUsingId(1);
    }

    return redirect()->route('dashboard');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::post('/students', [StudentController::class, 'store'])->name('students.store');
    Route::get('/students', [StudentController::class, 'index'])->name('students.index');

    Route::post('/records', [RecordController::class, 'store'])->name('records.store');
    Route::get('/records', [RecordController::class, 'index'])->name('records.index');
});

require __DIR__ . '/auth.php';
