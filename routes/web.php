<?php

use App\Http\Controllers\EmployeesController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\EmployeeDashboard;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthEmployeeController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;


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
    return redirect()->route('dashboard');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['verified', 'auth'])->name('dashboard');

Route::middleware(['guest:employees'])->group(function () {
    Route::get('login', [AuthenticatedSessionController::class, 'create'])
        ->name('login');
    Route::post('login', [AuthenticatedSessionController::class, 'store']);
});


Route::middleware('custom_middleware')->group(function () {
    Route::get('employee/dashboard', [EmployeeDashboard::class, 'dashboard'])->name('employee.dashboard');
    Route::post('employee/logout', [AuthEmployeeController::class, 'logout'])
        ->name('employee.logout');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('employee', EmployeesController::class);
});



require __DIR__ . '/auth.php';

//[EmployeeDashboard::class,'dashboard']
