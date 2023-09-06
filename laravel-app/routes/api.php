<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

use App\Models\Users;
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

/*
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
*/

Route::post('register', [AuthController::class, 'register']); 

Route::get('/test',function(){
    $users = Users::all();
    print_r($users); 
});
/*
Route::get('/api',function(){
    return "Test api"; exit;
});

Route::get('test, AuthController@test'); 
Route::post('/login, AuthController@login');

Route::post('/register, AuthController@register');
*/