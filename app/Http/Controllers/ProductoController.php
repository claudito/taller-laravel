<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class ProductoController extends Controller
{
    

  function index(){


   return view('crud.index');


  }


  function all(){
 
  //Query Builder
  #$productos = DB::table('productos')->select('id','codigo','descripcion','fecha_registro','unidad','lote')->get();
   
   //SQL Puro
   $productos  = DB::select(DB::raw("
    
    SELECT 
    
    id,
    codigo,
    descripcion,
    fecha_registro,
    unidad,
    lote
    
    FROM productos

    "));


  $productos = array('data'=>$productos);

  return $productos;


  }


  function consulta(Request $request){
 
  //Query Builder
  #$productos = DB::table('productos')->select('id','codigo','descripcion','fecha_registro','unidad','lote')->get();
   
   //SQL Puro
   $productos  = DB::select(DB::raw("
    
    SELECT 
    
    id,
    codigo,
    descripcion,
    fecha_registro,
    unidad,
    lote
    
    FROM productos WHERE id=:id

    "),[':id'=>$request->id]);


  return $productos;


  }


  



  function agregar(Request $request){

   
   try {
   	
   DB::table('productos')->insert(
    [ 

     'codigo'        =>$request->codigo,
     'descripcion'   =>$request->descripcion,
     'fecha_registro'=>$request->fecha_registro,
     'unidad'        =>$request->unidad,
     'lote'          =>$request->lote

    ]
   );

    return array(

    'title' => 'Buen Trabajo',
    'text'  => 'Registro Agregado',
    'type'  => 'success',
    'timer' => 3000


   );


   } catch (Exception $e) {


    return array(

    'title' => 'Error',
    'text'  => $e->getMessage(),
    'type'  => 'error',
    'timer' => 3000


   );

   	
   }

   
 
  }


  function actualizar(Request $request){

   
   try {
   	
     DB::table('productos')
              ->where('id', $request->id)
              ->update([


			'codigo'        =>$request->codigo,
			'descripcion'   =>$request->descripcion,
			'fecha_registro'=>$request->fecha_registro,
			'unidad'        =>$request->unidad,
			'lote'          =>$request->lote

              ]);

    return array(

    'title' => 'Buen Trabajo',
    'text'  => 'Registro Actualizado',
    'type'  => 'success',
    'timer' => 3000


   );


   } catch (Exception $e) {


    return array(

    'title' => 'Error',
    'text'  => $e->getMessage(),
    'type'  => 'error',
    'timer' => 3000


   );

   	
   }

   
 
  }


  function eliminar(Request $request){

   
   try {
   	
    DB::table('productos')->where('id', '=', $request->id)->delete();

    return array(

    'title' => 'Buen Trabajo',
    'text'  => 'Registro Eliminado',
    'type'  => 'success',
    'timer' => 3000


   );


   } catch (Exception $e) {


    return array(

    'title' => 'Error',
    'text'  => $e->getMessage(),
    'type'  => 'error',
    'timer' => 3000


   );

   	
   }

   
 
  }




}
