<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\LoginController;



Route::get('/', function () {
    return view('frontend.layout');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('user_role');
// Route::get('/{anyPath}', [App\Http\Controllers\HomeController::class, 'index'])->where('path','*');


#users
Route::middleware(['auth','user_role','user.access'])->group(function (){
    Route::get('/users', [App\Http\Controllers\UserController::class, 'index']);
    
    Route::post('/user/delete/all', [App\Http\Controllers\UserController::class, 'deleteAll']);
    Route::post('/user/change/all', [App\Http\Controllers\UserController::class, 'activeAll']);
    Route::post('/user/role/all', [App\Http\Controllers\UserController::class, 'roleAll']);
});


#categories
Route::middleware(['auth','user_role'])->group(function (){
    Route::get('/all-categories', [App\Http\Controllers\CategoryController::class, 'index']);
    Route::post('/category/create', [App\Http\Controllers\CategoryController::class, 'store']);
    Route::get('/category/delete/{slug}', [App\Http\Controllers\CategoryController::class, 'destroy']);
    Route::get('/category/show/{slug}', [App\Http\Controllers\CategoryController::class, 'show']);
    Route::post('/category/update/', [App\Http\Controllers\CategoryController::class, 'update']);
    Route::post('/category/delete/all', [App\Http\Controllers\CategoryController::class, 'deleteAll']);
    Route::post('/category/change/all', [App\Http\Controllers\CategoryController::class, 'activeAll']);
});
Route::get('/all-active-categories', [App\Http\Controllers\CategoryController::class, 'activeCategories']);


#posts
Route::middleware(['auth','user_role'])->group(function (){
    Route::get('/all-posts', [App\Http\Controllers\PostController::class, 'index']);
    Route::post('/post/create', [App\Http\Controllers\PostController::class, 'store']);
    Route::get('/post/delete/{slug}', [App\Http\Controllers\PostController::class, 'destroy']);
    Route::get('/post/show/{id}', [App\Http\Controllers\PostController::class, 'show']);
    Route::post('/post/update/', [App\Http\Controllers\PostController::class, 'update']);
    Route::post('/post/delete/all', [App\Http\Controllers\PostController::class, 'deleteAll']);
    Route::post('/post/change/all', [App\Http\Controllers\PostController::class, 'activeAll']);
    Route::get('/all-sliders', [App\Http\Controllers\PostController::class, 'sliders']);
    Route::post('/add/slider', [App\Http\Controllers\PostController::class, 'addSlider']);
    Route::post('/slider/position', [App\Http\Controllers\PostController::class, 'sliderPosition']);
    Route::post('/slider/delete/all', [App\Http\Controllers\PostController::class, 'removeSlider']);
});
Route::get('/all-active-posts', [App\Http\Controllers\PostController::class, 'activePosts']);
Route::get('/all-category-posts/{slug}', [App\Http\Controllers\PostController::class, 'categoryPosts']);
Route::get('/post/{slug}', [App\Http\Controllers\PostController::class, 'showPost']);
Route::get('/active-sliders', [App\Http\Controllers\PostController::class, 'sliders']);

//search By
Route::post('/search', [App\Http\Controllers\PostController::class, 'search']);




#checking auth
Route::get('/check-auth', [App\Http\Controllers\PostController::class, 'checkAuth']);

Route::get('/block',function(){
    return 'you are blocked';
})->middleware(['auth','user.status']);


//google auth


Route::get('sociallogin/{provider}', [LoginController::class, 'SocialSignup']);
Route::get('auth/google/callback', [LoginController::class, 'index']);






