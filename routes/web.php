<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\PositionController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('view.login');
Route::post('/store-login', [AuthController::class, 'login'])->name('login');
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('view.register');
Route::post('/store-register', [AuthController::class, 'register'])->name('register');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/users', [UserController::class, 'userIndex'])->name('users.index');
Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
Route::post('/users', [UserController::class, 'store'])->name('users.store');
Route::get('/users/{id}', [UserController::class, 'edit'])->name('users.edit');
Route::put('/users/{id}', [UserController::class, 'update'])->name('users.update');
Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('users.destroy');

Route::get('/employees', [EmployeeController::class, 'Index'])->name('employees.index');
Route::get('/employees/create', [EmployeeController::class, 'create'])->name('employees.create');
Route::post('/employees', [EmployeeController::class, 'store'])->name('employees.store');
Route::get('/employees/{id}', [EmployeeController::class, 'edit'])->name('employees.edit');
Route::put('/employees/{id}', [EmployeeController::class, 'update'])->name('employees.update');
Route::delete('/employees/{id}', [EmployeeController::class, 'destroy'])->name('employees.destroy');

Route::get('/positions', [PositionController::class, 'Index'])->name('positions.index');
Route::get('/positions/create', [PositionController::class, 'create'])->name('positions.create');
Route::post('/positions', [PositionController::class, 'store'])->name('positions.store');
Route::get('/positions/{id}', [PositionController::class, 'edit'])->name('positions.edit');
Route::put('/positions/{id}', [PositionController::class, 'update'])->name('positions.update');
Route::delete('/positions/{id}', [PositionController::class, 'destroy'])->name('positions.destroy');

Route::get('/roles', [RoleController::class, 'Index'])->name('roles.index');
Route::get('/roles/create', [RoleController::class, 'create'])->name('roles.create');
Route::post('/roles', [RoleController::class, 'store'])->name('roles.store');
Route::get('/roles/{id}', [RoleController::class, 'edit'])->name('roles.edit');
Route::put('/roles/{id}', [RoleController::class, 'update'])->name('roles.update');
Route::delete('/roles/{id}', [RoleController::class, 'destroy'])->name('roles.destroy');
