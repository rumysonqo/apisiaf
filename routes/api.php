<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('/mostrar_todo','App\Http\Controllers\ctrl_repsiaf@mostrar_todo');
Route::get('/totales','App\Http\Controllers\ctrl_repsiaf@totales');
Route::get('/ejec_fuente','App\Http\Controllers\ctrl_repsiaf@ejec_fuente');
Route::get('/ejec_generica','App\Http\Controllers\ctrl_repsiaf@ejec_generica');
Route::get('/programas','App\Http\Controllers\ctrl_repsiaf@programas');
Route::get('/totales_programa/{prg}','App\Http\Controllers\ctrl_repsiaf@totales_programa');
Route::get('/ejec_fuente_programa/{prg}','App\Http\Controllers\ctrl_repsiaf@ejec_fuente_programa');
Route::get('/ejec_generica_programa/{prg}','App\Http\Controllers\ctrl_repsiaf@ejec_generica_programa');
Route::get('/ejec_meta/{prg}','App\Http\Controllers\ctrl_repsiaf@ejec_meta');
Route::get('/genericas','App\Http\Controllers\ctrl_repsiaf@genericas');
Route::get('/fuentes','App\Http\Controllers\ctrl_repsiaf@fuentes');
Route::get('/ejec_meta_gen_fte/{prg}/{gen}/{fte}','App\Http\Controllers\ctrl_repsiaf@ejec_meta_gen_fte');
Route::get('/ejec_fte_gen/{fte}','App\Http\Controllers\ctrl_repsiaf@ejec_fte_gen');
Route::get('/ejec_prg_fte_gen/{prg}/{fte}','App\Http\Controllers\ctrl_repsiaf@ejec_prg_fte_gen');
Route::get('/ejec_prg_gen_fte_espec/{prg}/{gen}/{fte}','App\Http\Controllers\ctrl_repsiaf@ejec_prg_gen_fte_espec');
