<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ReportesController;
use App\Http\Controllers\PlanillaController;
use Illuminate\Support\Facades\Route;

Route::get('/portal', [HomeController::class, 'index']);

Route::get('/', [HomeController::class, 'Admin']);

Route::get('/planillas', [PlanillaController::class, 'index']);
Route::post('/planillas/crear', [PlanillaController::class, 'store']);

Route::get('/planillas/ver/{uuid}', [PlanillaController::class, 'ver']);
Route::put('/planilla/Asistencia/{planillaUUID}/{usuarioUUID}', [PlanillaController::class, 'Asistencia']);
Route::delete('/planillas/borrar/{uuid}', [PlanillaController::class, 'eliminar']);

Route::get('/usuario/buscar', [App\Http\Controllers\UsuarioController::class, 'buscar']);
Route::get('/Usuario/crear', [App\Http\Controllers\UsuarioController::class, 'crear']);

Route::post('/Usuario/store', [App\http\Controllers\UsuarioController::class,'store']);
Route::get('/Usuario/editar/{uuid}', [App\Http\Controllers\UsuarioController::class, 'editar']);
Route::put('/Usuario/update/{uuid}', [App\http\Controllers\UsuarioController::class,'update']);
Route::delete('/Usuario/borrar/{uuid}', [App\Http\Controllers\UsuarioController::class, 'eliminar']);


Route::get('/Reportes',[App\Http\Controllers\ReportesController::class, 'index']);

Route::post('/Reportes',[App\Http\Controllers\ReportesController::class, 'fecha']);
