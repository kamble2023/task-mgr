<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TaskController;

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


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    $a = $request->user();
    print_r($a); exit;
    //return $request->user();
});


Route::post('register', [AuthController::class, 'register']); 
Route::post('login', [AuthController::class, 'login']); 
Route::post('logout', [AuthController::class, 'logout']); 

Route::middleware('auth:sanctum')->post('category/store', [CategoryController::class, 'store']); 
Route::middleware('auth:sanctum')->post('category/delete', [CategoryController::class, 'delete']); 
Route::middleware('auth:sanctum')->post('category/update', [CategoryController::class, 'update']);

/** Routes for Task*/ 
Route::middleware('auth:sanctum')->post('task/store', [TaskController::class, 'store']); 
Route::middleware('auth:sanctum')->post('task/update', [TaskController::class, 'update']);
Route::middleware('auth:sanctum')->post('task/delete', [TaskController::class, 'delete']); 

Route::middleware('auth:sanctum')->post('profile/update', [AuthController::class, 'updateProfile']);

Route::post('/test',function(){
    //$users = Users::all(); echo $users[0]->name; exit;
    $user = auth()->user();
    print_r($user); 
});
/*
Route::get('/api',function(){
    return "Test api"; exit;
});

Route::get('test, AuthController@test'); 
Route::post('/login, AuthController@login');

Route::post('/register, AuthController@register');
*/