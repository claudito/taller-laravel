<?php

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



Route::get('perfil',function(){

 //return '/var/www/taller-laravel/public';
	//return 'login';

	//return 'Contacto';

   
   $name  = "LUIS AUGUSTO CLAUDIO PONCE";


    return view('perfil',compact('name'));


});


Route::get('api/users',function(){


 return  array(

   
  array('id'=>1,'name'=>'Luis Claudio'),
  array('id'=>2,'name'=>'Juan Perez')



 );


});
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
