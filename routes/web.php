<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Login;
use App\Http\Controllers\PedidodeCompraController;
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

Route::get('/', [PedidodeCompraController::class, 'index'])->name('formPrincipal');
Route::get('/login', function () {
    return view('login');
});
Route::post('/login', [Login::class, 'login'])->name('login');
Route::post('/logout', [Login::class, 'logout'])->name('logout');

Route::post('/crearPedido', [PedidodeCompraController::class, 'crearPedido'])->name('crearPedido');
Route::get('/consultaCompra', [PedidodeCompraController::class, 'consultaCompra'])->name('consultaCompra');

Route::get('/clientes', [PedidodeCompraController::class, 'consultaCliente'])->name('consultaCliente');
Route::get('/producto', [PedidodeCompraController::class, 'consultaProducto'])->name('consultaProducto');
Route::post('/pedidos/add-producto', [PedidodeCompraController::class, 'addProducto'])->name('pedidos.addProducto');
Route::post('/pedidos/remove-producto', [PedidodeCompraController::class, 'removeProducto'])->name('pedidos.removeProducto');
Route::post('/pedidos/update-quantity', [PedidodeCompraController::class, 'updateQuantity'])->name('pedidos.updateQuantity'); // Nueva
Route::get('/pedidos/fetch-carrito', [PedidodeCompraController::class, 'fetchCarrito'])->name('pedidos.fetchCarrito');       // Opcional, para recargar el carrito