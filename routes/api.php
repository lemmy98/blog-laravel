<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\AuthController;
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

//Auth Routes
Route::post('/auth/register', [AuthController::class, 'register']);
Route::post('/auth/login', [AuthController::class, 'login']);
Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::post('/auth/logout', [AuthController::class, 'logout']);
});

    //Article Routes
Route::prefix("article")->middleware("auth:sanctum")->group(function (){
    Route::get("",[ArticleController::class, "index"]);
    Route::post("", [ArticleController::class, "store"])->middleware("article");
    Route::get("{article_id}", [ArticleController::class, "show"]);
    Route::put("{article_id}", [ArticleController::class, "update"]);
    Route::delete("{article_id}", [ArticleController::class, "destroy"]);

});


//apiResourceRoute
//Route::apiResource("articles", ArticleController::class);
