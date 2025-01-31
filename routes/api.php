<?php

use App\Http\Controllers\EnderecoController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PessoaController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::resource('pessoas', PessoaController::class);
Route::post('pessoas/{pessoaId}/enderecos', [EnderecoController::class, 'store']);
Route::put('enderecos/{id}', [EnderecoController::class, 'update']);
Route::delete('enderecos/{id}', [EnderecoController::class, 'destroy']);
