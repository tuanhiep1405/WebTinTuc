<?php

use App\Http\Controllers\Admin\Categories;
use App\Http\Controllers\Admin\CategoriesController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Client\DetailController;
use App\Http\Controllers\Client\HomeController;
use App\Http\Controllers\Client\TinTagController;
use App\Http\Controllers\Client\TTLController;
use App\Http\Controllers\LoginOutController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

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

/*======================Client============================== */


Route::get('/',[HomeController::class,'index']);
   
Route::get('/search', [HomeController::class, 'search'])->name('search');


Route::get('/detail/{id}',[DetailController::class,'index']);
Route::post('/comment', [DetailController::class, 'store'])->name('comment.store');

Route::get('/category/{id}',[TTLController::class,'index']);

Route::get('/chuDe/{id}',[TinTagController::class,'index']);


Route::get('login-logout' ,function(){
  $cate = DB::table('categories')->get();

return view('client.login-logout',compact('cate'));
})->name('login');


/*======================Admin============================== */


Route::get('dashboard',function(){
return view('admin.index');
});

Route::resource('user',UserController::class);
Route::get('listLook',[UserController::class,'listLook']);
Route::post('/user/{id}/lock',[UserController::class,'look'])->name('user.lock');
Route::post('/user/{id}/unlock',[UserController::class,'unlock'])->name('user.unlock');

Route::resource('categories',CategoriesController::class);

// Auth::routes();

// Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('/');
