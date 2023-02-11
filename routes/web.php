<?php

use App\Http\Controllers\employees\EmployeesController;
use Illuminate\Support\Facades\Route;

Route::get('/', [EmployeesController::class, 'index'])->name('index.employee');
Route::get('empleado/crear', [EmployeesController::class, 'create'])->name('create.employee');
Route::post('empleado/guardar', [EmployeesController::class, 'save'])->name('save.employee');
Route::get('empleado/editar/{data}', [EmployeesController::class, 'edit'])->name('edit.employee');
Route::put('empleado/actualizar/{id}', [EmployeesController::class, 'update'])->name('update.employee');
Route::delete('empleado/eliminar/{id}', [EmployeesController::class, 'delete'])->name('delete.employee');
