<?php
use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization as FacadesLaravelLocalization;
//use Mcamara\LaravelLocalization\LaravelLocalization;
define('PAGINATION_COUNT',5);
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

Auth::routes(['verify'=>true]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('verified');

Route::get('/', function(){
    return 'home';
});

Route::get('/dashboard', function(){
    return 'under 15';
})->name('not.adult');


Route::get('/redirect/{service}', [App\Http\Controllers\SocialController::class,'redirect']);

Route::get('/callback/{service}', [App\Http\Controllers\SocialController::class,'callback']);

Route::get('fillable',[App\Http\Controllers\CrudController::class, 'getOffers']);


Route::group(['prefix'=> FacadesLaravelLocalization::setLocale(),'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]],function(){

Route::group(['prefix'=>'offers'],function(){
  //  Route::get('store',[App\Http\Controllers\CrudController::class, 'store']);

    Route::get('create',[App\Http\Controllers\CrudController::class, 'create']);
    Route::post('store',[App\Http\Controllers\CrudController::class, 'store'])->name('offers.store');

    Route::get('edit/{offer_id}',[App\Http\Controllers\CrudController::class, 'editOffer']);
    Route::post('update/{offer_id}',[App\Http\Controllers\CrudController::class, 'updateOffer'])->name('offers.update');
    Route::get('delete/{offer_id}',[App\Http\Controllers\CrudController::class, 'delete'])->name('offers.delete');
    Route::get('all',[App\Http\Controllers\CrudController::class, 'getAlloffers'])->name('offers.all');
    Route::get('get-all-inactive-offers',[App\Http\Controllers\CrudController::class, 'getAllInactiveOffers']);
});

Route::get('youtube',[App\Http\Controllers\CrudController::class, 'getVideo'])->middleware('auth');
});



//ajax
Route::group(['prefix'=>'ajax-offers'],function(){
    Route::get('create',[App\Http\Controllers\OfferController::class, 'create']);
    Route::post('store',[App\Http\Controllers\OfferController::class, 'store'])->name('ajax.offers.store');
    Route::get('all',[App\Http\Controllers\OfferController::class, 'all'])->name('ajax.offers.all');
    Route::post('delete',[App\Http\Controllers\OfferController::class, 'delete'])->name('ajax.offers.delete');

    Route::get('edit/{offer_id}',[App\Http\Controllers\OfferController::class, 'edit'])->name('ajax.offers.edit');
    Route::post('update',[App\Http\Controllers\OfferController::class, 'update'])->name('ajax.offers.update');
});




//authentication &&guards
Route::group(['middleware'=>'CheckAge'],function(){
    Route::get('adults',[App\Http\Controllers\Auth\CustomAuthController::class,'Adults'])->name('adults');
});

Route::get('site',[App\Http\Controllers\Auth\CustomAuthController::class,'site'])->middleware('auth:web')->name('site');
Route::get('admin',[App\Http\Controllers\Auth\CustomAuthController::class,'admin'])->middleware('auth:admin')->name('admin');
Route::get('admin/login',[App\Http\Controllers\Auth\CustomAuthController::class,'adminlogin'])->name('admin.login');
Route::post('admin/login',[App\Http\Controllers\Auth\CustomAuthController::class,'checkadminlogin'])->name('save.admin.login');




//relations
Route::get('has-one',[App\Http\Controllers\Relation\RelationsController::class,'hasOneRelation']);

Route::get('has-one-reverse',[App\Http\Controllers\Relation\RelationsController::class,'hasOneRelationReverse']);

Route::get('get-user-has-phone',[App\Http\Controllers\Relation\RelationsController::class,'getUserHasPhone']);
Route::get('get-user-not-has-phone',[App\Http\Controllers\Relation\RelationsController::class,'getUserNotHasPhone']);
Route::get('get-user-has-phone-with-condition',[App\Http\Controllers\Relation\RelationsController::class,'getUserWhereHasPhoneWithCondition']);


//one to many relations
Route::get('hospital-has-many',[App\Http\Controllers\Relation\RelationsController::class,'getHospitalDoctors']);

Route::get('hospitals',[App\Http\Controllers\Relation\RelationsController::class,'hospitals'])->name('hospital.all');

Route::get('doctors/{hospital_id}',[App\Http\Controllers\Relation\RelationsController::class,'doctors'])->name('hospital.doctors');




Route::get('hospitals/{hospital_id}',[App\Http\Controllers\Relation\RelationsController::class,'deleteHospital'])->name('hospital.delete');

Route::get('hospitals-has-doctors',[App\Http\Controllers\Relation\RelationsController::class,'hospitalsHasDoctor']);
Route::get('hospitals-has-doctors-male',[App\Http\Controllers\Relation\RelationsController::class,'hospitalsHasOnlyMaleDoctors']);
Route::get('hospitals-not-has-doctors',[App\Http\Controllers\Relation\RelationsController::class,'hospitalsNotHasDoctors']);

//many to many
Route::get('doctors-services',[App\Http\Controllers\Relation\RelationsController::class,'getDoctorServices']);
Route::get('service-doctors',[App\Http\Controllers\Relation\RelationsController::class,'getServiceDoctors']);


Route::get('doctors/services/{doctor_id}',[App\Http\Controllers\Relation\RelationsController::class,'getDoctorServicesByID'])->name('doctors.services');
Route::post('saveServices-to-doctor',[App\Http\Controllers\Relation\RelationsController::class,'saveServicesToDoctors'])->name('save.doctors.services');


//has one through
Route::get('has-one-through',[App\Http\Controllers\Relation\RelationsController::class,'getPatientDoctor']);

//has many through
Route::get('has-many-through',[App\Http\Controllers\Relation\RelationsController::class,'getCountryDoctor']);



//accessors and mutators
Route::get('accessors',[App\Http\Controllers\Relation\RelationsController::class,'getDoctors']);


//collections
Route::get('collection',[App\Http\Controllers\CollectTutorial::class,'index']);
Route::get('maincats',[App\Http\Controllers\CollectTutorial::class,'complex']);
Route::get('main-cats',[App\Http\Controllers\CollectTutorial::class,'complexFilter']);
Route::get('main-cats3',[App\Http\Controllers\CollectTutorial::class,'complexTransform']);
