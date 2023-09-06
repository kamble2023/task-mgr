<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Models\Users;
use App\Http\Controllers\AuthController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/register', function () {
    return view('register');
});
Route::get('/test',function(){
    $users = Users::all();
    print_r($users); 
});

Route::middleware('auth:sanctum')->post('/user/profile', function (Request $request) {
    // $user =  $request->user(); //print_r($a); exit;
    // return view('profile', $user);
    //return redirect()->route('profile', [$user]);
    //echo "UN# ".$a[0]->name; exit;
    return $request->user();
});
//Route::middleware('auth:sanctum')->get('/user/profile', 'App\Http\Controllers\AuthController@profile'); 

//Route::get('/dashboard', [DashboardController::class, 'show']);
Route::get('/dashboard', 'App\Http\Controllers\DashboardController@show');
Route::get('/categories/list', 'App\Http\Controllers\CategoryController@list');
Route::get('/category/add', 'App\Http\Controllers\CategoryController@create');
Route::get('/category/edit/{id}', 'App\Http\Controllers\CategoryController@edit');

// Routes for Task 
Route::get('/task/list', 'App\Http\Controllers\TaskController@list');
Route::get('/task/add', 'App\Http\Controllers\TaskController@add');
Route::get('/task/edit/{id}', 'App\Http\Controllers\TaskController@edit');