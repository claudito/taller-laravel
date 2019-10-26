<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<title>Productos</title>

<!-- Bootstrap 4 -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" >

<script src="https://code.jquery.com/jquery-3.3.1.js" ></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>


<!-- Datatable -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css">

<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>

<!-- FontAwesome -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

<!-- Sweet Alert 2 -->

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>

</head>
<body>


<div class="container-fluid">
	
<div class="row">
	
<div class="col-md-12">
	

<div class="card">
	
<div class="card-header">
Productos 

<div class="pull-right">
	
<button class="btn btn-primary btn-sm btn-agregar"><i class="fa fa-plus"></i> Agregar</button>

</div>

</div>

<div class="card-body">
	
<div class="table-responsive">
	
<table class="table" id="consulta">

<thead>
	
<tr>
<th>id</th>
<th>Código</th>
<th>Descripción</th>
<th>Fecha de Registro</th>
<th>Unidad</th>
<th>Lote</th>
<th>Acciones</th>
</tr>

</thead>

	

</table>

</div>



</div>


</div>



</div>


</div>

</div>

<!-- Modal Registro(Agregar/Actualizar) -->
<form id="registro" autocomplete="off">
	
<div class="modal fade" id="modal-registro" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

      <!-- CSRF -->
       @csrf
        
       <input type="hidden" name="ruta"   class="ruta">
       <input type="hidden" name="tipo"   class="tipo">
       <input type="hidden" name="id"     class="id">

       <div class="form-group">
       <label>Código</label>
       <input type="text" name="codigo" class="codigo form-control" required>
       </div>

      <div class="form-group">
       <label>Descripción</label>
       <input type="text" name="descripcion" class="descripcion form-control" required>
       </div>

       <div class="form-group">
       <label>Fecha de Registro</label>
       <input type="date" name="fecha_registro" class="fecha_registro form-control" required>
       </div>

       <div class="form-group">
       <label>Unidad</label>
       <select name="unidad" class="unidad form-control" required>
       <option value="">[Seleccionar]</option>
       <option value="und">UND</option>
       <option value="jgo">JGO</option>
       <option value="lt">LT</option>
       </select>
       </div>


       <div class="form-group">
       <label>Lote</label>
       <input type="text" name="lote" class="lote form-control" required>
       </div>



      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-primary btn-submit">Save changes</button>
      </div>
    </div>
  </div>
</div>



</form>



<script>
	
function loadData(){

$(document).ready(function(){

$('#consulta').DataTable({

"destroy":true,
"bAutoWidth":false,
"language":{

 "url":"https://cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"

},
"ajax":"{{ route('productos.all') }}",
"columns":[

 {"data":"id"},
 {"data":"codigo"},
 {"data":"descripcion"},
 {"data":"fecha_registro"},
 {"data":"unidad"},
 {"data":"lote"},
 {"data":null,render:function(data){

  acciones  = '<button class="btn btn-primary btn-sm btn-edit" data-id="'+data.id+'" ><i class="fa fa-edit"></i></button> ';
  acciones  += '<button class="btn btn-danger btn-sm btn-delete" data-id="'+data.id+'"><i class="fa fa-trash"></i></button>';


  return acciones;


 }}


]




});


});


}

loadData();


//Cargar Modal Agregar
$(document).on('click','.btn-agregar',function(){

$('#registro')[0].reset();

$('.ruta').val('{{ route('productos.agregar') }}');
$('.tipo').val('POST');
$('.btn-submit').html('Agregar');
$('.modal-title').html('Agregar');
$('#modal-registro').modal('show');

});


//Cargar Modal Actualizar
$(document).on('click','.btn-edit',function(){

$('#registro')[0].reset();

id = $(this).data('id');

//Cargar Data
$.ajax({

url:'{{ route('productos.consulta') }}',
type:'GET',
data:{'id':id},
dataType:'JSON',
success:function(data){

//alert(data[0].codigo);

$('.codigo').val(data[0].codigo);
$('.descripcion').val(data[0].descripcion);
$('.fecha_registro').val(data[0].fecha_registro);
$('.unidad').val(data[0].unidad);
$('.lote').val(data[0].lote);



}



});





$('.id').val(id);
$('.ruta').val('{{ route('productos.actualizar') }}');
$('.tipo').val('PUT');
$('.btn-submit').html('Actualizar');
$('.modal-title').html('Actualizar');
$('#modal-registro').modal('show');

});



//Cargar Modal Eliminar
$(document).on('click','.btn-delete',function(){

 id = $(this).data('id');



// alert(id);

Swal.fire({
  title: '¿Estás Segur@?',
  text: "Está acción eliminará permanentemente el registro",
  type: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Si, estoy seguro',
  cancelButtonText : 'Cancelar',
}).then((result) => {
  if (result.value) {

    //AJAX
     $.ajax({
      
       headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
      url:'{{ route('productos.eliminar')}}',
      type:'DELETE',
      data:{'id':id},
      dataType:'JSON',
      beforeSend:function(){
   

	Swal.fire({

	title : "Cargando...",
	text  : "Espere un momento porfavor",
	imageUrl:"https://raw.githubusercontent.com/claudito/curso-php/master/semana04/img/loader2.gif",
	showConfirmButton:false


	})



      },
      success:function(data){

       loadData();
   Swal.fire({

    title : data.title,
    text  : data.text,
    type  : data.type,
    timer : data.timer,
    showConfirmButton:false


   });




      }



     });




  }
})





});

//Registro
$(document).on('submit','#registro',function(e){

 parametros = $(this).serialize();

 ruta = $('.ruta').val();
 tipo = $('.tipo').val();

 $.ajax({

 
  url:ruta,
  type:tipo,
  data:parametros,
  dataType:'JSON',
  beforeSend:function(){

   
	Swal.fire({

	title : "Cargando...",
	text  : "Espere un momento porfavor",
	imageUrl:"https://raw.githubusercontent.com/claudito/curso-php/master/semana04/img/loader2.gif",
	showConfirmButton:false


	})



  },
  success:function(data){

    loadData();
    $('#modal-registro').modal('hide');

   Swal.fire({

    title : data.title,
    text  : data.text,
    type  : data.type,
    timer : data.timer,
    showConfirmButton:false


   });



  }





 });


e.preventDefault();
});


</script>
</body>
</html>