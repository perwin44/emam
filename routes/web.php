<?php

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization as FacadesLaravelLocalization;
//use Mcamara\LaravelLocalization\LaravelLocalization;

//class Auth extends Illuminate\Support\Facades\Facade;

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

{}Route::get('/', function () {
    $data=[];
    $data['id']=5;
    $data['name']='ahmed';
    return view('welcome',$data)/*->with(['string'=>'ahmed','age'=>27])*/;
});

Route::get('index',[App\Http\Controllers\Front\UserController::class,'getIndex']);

Route::get('/test1', function () {
    return 'welcome';
})->name('a');

Route::namespace('Front')->group(function(){
Route::get('users',[App\Http\Controllers\Front\UserController::class,'showUserName']);
});

Route::get('check',function(){
    return 'middleware';
})->middleware('auth');


Route::get('/second',[App\Http\Controllers\admin\SecondController::class,'showString']);

Route::get('login',function(){
return 'login';
})->name('login');
/*Route::group(['middleware'=>'auth'],function(){
Route::get('users','UserController@showUserName');
});*/


Route::resource('/news','');

/*Route::get('news','NewsController@index');
Route::post('news','NewsController@store');
Route::get('news/create','NewsController@create');
*/


Route::get('/landing', function () {
    return view ('landing');
});

Route::get('/about', function () {
    return view ('about');
});

//Auth::routes(['verify'=>true]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('verified');

Route::get('/', function(){
    return 'home';
});

Route::get('/dashboard', function(){
    return 'dashboard';
});


Route::get('/redirect/{service}', [App\Http\Controllers\SocialController::class,'redirect']);

Route::get('/callback/{service}', [App\Http\Controllers\SocialController::class,'callback']);

Route::get('fillable',[App\Http\Controllers\CrudController::class, 'getOffers']);


Route::group(['prefix'=> FacadesLaravelLocalization::setLocale(),'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]],function(){

Route::group(['prefix'=>'offers'],function(){
  //  Route::get('store',[App\Http\Controllers\CrudController::class, 'store']);

    Route::get('create',[App\Http\Controllers\CrudController::class, 'create']);
    Route::post('store',[App\Http\Controllers\CrudController::class, 'store'])->name('offers.store');
});
});
