<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\CategoryTaskController;
use App\Http\Controllers\DashboardController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

//categories 
Route::group(['middleware' => ['auth']],function(){
Route::get('/dashboard',[DashboardController::class,'dashboard'])->name('dashboard');

Route::get('/categories', [CategoriesController::class,'index'])->name('categories.index');
Route::get('/categories/create', [CategoriesController::class,'create'])->name('categories.create');
Route::post('/categories/store', [CategoriesController::class,'store'])->name('categories.store');
Route::get('/categories/edit/{id}', [CategoriesController::class,'edit'])->name('categories.edit');
Route::put('/categories/update/{id}', [CategoriesController::class,'update'])->name('categories.update');
Route::delete('/categories/destroy/{id}', [CategoriesController::class,'destroy'])->name('categories.destroy');

Route::get('/task', [TaskController::class,'index'])->name('task.index');
Route::get('/task/create', [TaskController::class,'create'])->name('task.create');
Route::post('/task/store', [TaskController::class,'store'])->name('task.store');
Route::get('/task/edit/{id}', [TaskController::class,'edit'])->name('task.edit');
Route::put('/task/update/{id}', [TaskController::class,'update'])->name('task.update');
Route::delete('/task/destroy/{id}', [TaskController::class,'destroy'])->name('task.destroy');

Route::get('/category/task', [CategoryTaskController::class,'index'])->name('category_task.index');
Route::get('/category/task/{categoryID}', [CategoryTaskController::class,'allTask'])->name('category_task.allTask');
Route::get('/category/task/create/{categoryID}',[CategoryTaskController::class,'createCategoryTask'])->name('category_task.createCategoryTask');
Route::post('/category/task/store',[CategoryTaskController::class,'storeCategoryTask'])->name('category_task.storeCategoryTask');
Route::get('/category/task/edit/{categoryID}',[CategoryTaskController::class,'edit'])->name('category_task.edit');
Route::put('/category/task/update/{categoryID}',[CategoryTaskController::class,'update'])->name('category_task.update');
Route::delete('/category/task/destroy/{categoryID}', [CategoryTaskController::class,'destroy'])->name('category_task.destroy');
Route::put('/category/task/updateStatus/{idTask}',[CategoryTaskController::class,'updateStatus'])->name('category_task.updateStatus');
});

// auth
Route::get('/login','AuthController@getLogin')->name('login');
Route::post('/login-post','AuthController@PostLogin')->name('postLogin');
Route::get('/logout','AuthController@logout')->name('logout');
Route::get('/register', 'AuthController@getRegister')->name('register');
Route::post('/register-post', 'AuthController@PostRegister')->name('postRegister');
    
//