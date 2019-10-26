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

    // return 'hola';

});


//Route::middleware('auth:api')->
/*
Route::get('productos',function(){

 
 return view('crud.index');
 

});*/

//Agregar    => POST
//Actualizar => PUT
//Eliminar   => DELETE

#Productos
Route::get('productos','ProductoController@index');
Route::get('productos_all','ProductoController@all')->name('productos.all');
Route::get('productos_consulta','ProductoController@consulta')->name('productos.consulta');
Route::post('productos_agregar','ProductoController@agregar')->name('productos.agregar');
Route::put('productos_actualizar','ProductoController@actualizar')->name('productos.actualizar');
Route::delete('productos_eliminar','ProductoController@eliminar')->name('productos.eliminar');


//Autenticación Laravel
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
