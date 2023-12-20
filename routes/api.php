<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\PedidoController;

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

// Rotas para Produto
Route::apiResource('produtos', ProdutoController::class);

// Rotas para Categoria
Route::apiResource('categorias', CategoriaController::class);

// Rotas para Pedido
Route::apiResource('pedidos', PedidoController::class);

// Rota para realizar pedido
Route::post('realizar-pedido', [PedidoController::class, 'realizarPedido']);

// Rota para calcular frete
Route::post('calcular-frete', [PedidoController::class, 'calcularFrete']);
