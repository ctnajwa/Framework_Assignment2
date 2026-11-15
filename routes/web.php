<?php

use App\Http\Controllers\CustomerController;
use Illuminate\Support\Facades\Route;

Route::get('/', fn () => redirect()->route('customers.index'));

Route::get('/customers', [CustomerController::class, 'index'])->name('customers.index');
Route::get('/customers/gender/{gender}', [CustomerController::class, 'filterByGender'])
    ->whereIn('gender', ['Male', 'Female'])
    ->name('customers.gender');
Route::get('/customers/birthday', [CustomerController::class, 'filterByBirthday'])->name('customers.birthday');