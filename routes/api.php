<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

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


/* Aquí se registran las rutas de la API del controlador de productos; cada función contiene un link asociado a ello, que se 
complementa con la dirección del host y el puerto. */
Route::controller(ProductController::class)->group(function() {
    Route::get('/showProducts', 'showProducts');
    Route::post('/addProducts', 'addProduct');
    Route::put('/deleteProduct', 'deleteProduct');
    Route::post('/getProduct', 'getProduct');
    Route::put('/updateProduct', 'updateProduct');
});