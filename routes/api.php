<?php

use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Http\Request;
use Illuminate\Routing\RouteGroup;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/test', function (Request $request) {

    $response = new \Illuminate\Http\Response(json_encode(['msg' => 'Minha Primeira resposta de API']));
    $response->header('Content-Type', 'application/json');

    return $response;
});

    //Products Route
    Route::prefix('products')->group(function(){
        Route::get('/', [ProductController::class, 'index']);
        Route::get('/{id}', [ProductController::class, 'show']);
        Route::post('/', [ProductController::class, 'save'])->middleware('auth.basic');
        Route::put('/', [ProductController::class, 'update']);
        Route::delete('/{id}', [ProductController::class, 'delete']);
    });


Route::resource('users', UserController::class);
