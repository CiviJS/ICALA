<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ReportesController;
use App\Http\Controllers\PlanillaController;
use App\Http\Controllers\UsuarioController;
use Illuminate\Support\Facades\Route;


Route::get('/portal', [HomeController::class, 'index']);
Route::post('/auth', [HomeController::class, 'auth']);
Route::get('/logout',[HomeController::class, 'logout']);
Route::get('/login', [HomeController::class, 'login']);



Route::middleware('check.auth')->group(function () {


Route::get('/', [HomeController::class, 'admin']);
Route::get('/planillas', [PlanillaController::class, 'index']);
Route::post('/planillas/crear', [PlanillaController::class, 'store']);

Route::get('/planillas/ver/{uuid}', [PlanillaController::class, 'ver']);
Route::put('/planilla/Asistencia/{planillaUUID}/{usuarioUUID}', [PlanillaController::class, 'asistencia']);
Route::delete('/planillas/borrar/{uuid}', [PlanillaController::class, 'eliminar']);

Route::get('/usuario/buscar', [UsuarioController::class, 'buscar']);
Route::get('/Usuario/crear', [UsuarioController::class, 'crear']);

Route::post('/Usuario/store', [UsuarioController::class,'store']);
Route::get('/Usuario/editar/{uuid}', [UsuarioController::class, 'editar']);
Route::put('/Usuario/update/{uuid}', [UsuarioController::class,'update']);
Route::delete('/Usuario/borrar/{uuid}', [UsuarioController::class, 'eliminar']);


Route::get('/Reportes',[ReportesController::class, 'index']);

Route::post('/Reportes',[ReportesController::class, 'index']);
});