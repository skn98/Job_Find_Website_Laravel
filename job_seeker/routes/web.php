<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Listing;
use App\Http\Controllers\ListingController;
use App\Http\Controllers\UserController;
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
// Route::get('/',function(){
//    return view('welcome');
// });

         // all listings
Route::get('/',[ListingController::class,'index']);

     // show create form
Route::get('/listings/create',[ListingController::class,
'create'])->middleware('auth');

     // store listing
Route::post('/listings',[ListingController::class,
'store'])->middleware('auth');

     //edit listings
Route::get('/listings/{listing}/edit',[ListingController::class,
'edit'])->middleware('auth');

     //edit submit to ubdate
Route::put('/listings/{listing}',[ListingController::class,
'update'])->middleware('auth');

  //delete listing
  Route::delete('/listings/{listing}',[ListingController::class,
  'destroy'])->middleware('auth');

  //manage Listing
  Route::get('/listings/manage', [ListingController::class, 'manage'])->middleware('auth');

      // single listings
Route::get('/listings/{listing}',[ListingController::class,'show' ]);

   //show registerform

 Route::get('/register',[UserController::class,
 'create'])->middleware('guest');

 //store users
 Route::post('/users',[UserController::class,'store']);

  // users logout
  Route::post('/logout',[UserController::class,
  'logout'])->middleware('auth');

  //show loginform

 Route::get('/login',[UserController::class,
 'login'])->name('login')->middleware('guest');

 //log in user
 Route::post('/users/authenticate',[UserController::class,'authenticate']);














          //Basic routing

// Route::get('/hello',function(){
//     return response('<h1>hellow world</h1>',200)
//     ->header('content-type','text/plain')
//     ->header('foo','bar');
// });


// Route::get('/posts/{id}',function($id){
//     return response('Post'.$id);
// })->where('id','[0-9]+');

//  Route::get('/search',function(Request $request){
//   return ($request->name .' ' . $request->city);
//  });
