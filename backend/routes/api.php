<?php

declare(strict_types=1);

use App\Http\Controllers\CardsController;
use Illuminate\Routing\Router;
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

Route::middleware([])
    ->group(
        static function (Router $router) {
            $router->apiResource('/cards', CardsController::class)->only(['index', 'store']);
        }
    );
