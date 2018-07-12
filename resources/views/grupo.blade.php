@extends('layouts.app')

@section('content')
@include('ajax.updateGrupo')
@include('ajax.insertGrupo')

<div class="container">
	<button type="button" class="btn btn-primary btn-s" onclick="crear()">Insertar Grupo</button>
	<br>
	<div class="row">
		<div class="col-md-8 col-md-offset-2">


			<div class="panel panel-default">

				
				<div class="panel-heading">Grupos Ingresados</div>

				<div class="panel-body">

					<table class="table table-striped table-bordered table-hover">
						<thead>
							<tr>
								<th width="20%"></th>
									<th width="10%"> Grupo</th>
								<th width="40%"> País</th>
								<th width="30%"> Bandera </th>

							</tr>
						</thead>
						<tbody>
							@foreach($data as $dt)
							<tr class="odd gradeX"  id="{!! $dt->id_grupo!!}">
								<td> <button class="btn btn-info btn-xs" onclick="editar('{!! $dt->id_grupo!!}')" id="editar" >Editar</button>
									<button class="btn btn-danger btn-xs" onclick="eliminar('{!! $dt->id_grupo!!}')" id="eliminar" > Eliminar </button></td>
									<td> <p class="text-center"> {{$dt->grupo}} </p></td>
									<td> <p class="text-center"> {{$dt->equipos}} </p></td>
									<td> <?php 
										$porciones = explode(",", $dt->img_equipo);
										echo "<img src=' " . asset("storage/upload/" . $porciones[0] ) ."'> ";
										echo "<img src=' " . asset("storage/upload/" . $porciones[1] ) ."'> "; 
										echo "<img src=' " . asset("storage/upload/" . $porciones[2] ) ."'> ";
										echo "<img src=' " . asset("storage/upload/" . $porciones[3] ) ."'> ";
									?> </td>
								</tr>
								@endforeach
							</tbody>
						</table>

					</div>
				</div>
			</div>
		</div>

	</div>
	@endsection
	@section('script')
	@endsection
	<script type="text/javascript">

		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}

		});
		function editar(id){

			$.get("{!! URL::to('grupo/edit') !!}",{id:id}, function(data){
			//	$('#id_grupo').val(data[0].id_grupo)
			//	$('#grupo').val(data[0].grupo)
				console.log(data);
				$("#modalGrupos").modal();
			});
		}
		function crear(){

			$.get("{!! URL::to('grupo/create') !!}",null, function(data){
		//	$('#id_grupo').val(data[0].id_grupo)
		//	$('#grupo').val(data[0].grupo)
		console.log(data);
			 //$("#equipo option").remove(); .
			 $.each(data, function(index, item) {
			 	$("#equipoA").append( 
			 		$("<option></option>") 
			 		.text(item.equipo)
			 		.val(item.id_equipo));
			 	$("#equipoB").append( 
			 		$("<option></option>") 
			 		.text(item.equipo)
			 		.val(item.id_equipo));
			 	$("#equipoC").append( 
			 		$("<option></option>") 
			 		.text(item.equipo)
			 		.val(item.id_equipo) );
			 	$("#equipoD").append( 
			 		$("<option></option>") 
			 		.text(item.equipo)
			 		.val(item.id_equipo));
			 	console.log(item.id_equipo);
			 });
			 $("#modalGrupos").modal();



			});
		}

		function eliminar(id){
			console.log(id);

			$.post("{!! URL::to('grupo/destroy') !!}",{id:id}, function(data){
				$('tr#' + id).remove();
				console.log(data);

			});
		}
		function revisargrupo(equipo, sel){
			var a = document.getElementById("equipoA").value;
			var b = document.getElementById("equipoB").value;
			var c = document.getElementById("equipoC").value;
			var d = document.getElementById("equipoD").value;

			if(sel == 'equipoA'){
				if(equipo==b || equipo == c || equipo == d){
					alert(equipo + ' Ya ha sido seleccionado');
					document.getElementById("equipoA").value='';
					document.getElementById("equipoA").text='';
				}
			}
			if(sel == 'equipoB'){
				if(equipo==a || equipo == c || equipo == d){
					
					alert(equipo + ' Ya ha sido seleccionado');
					document.getElementById("equipoB").value='';
					document.getElementById("equipoB").text='';
				}
			}
			if(sel == 'equipoC'){
				if(equipo==b || equipo == a || equipo == d){
					alert(equipo + ' Ya ha sido seleccionado');
					document.getElementById("equipoC").value='';
					document.getElementById("equipoC").text='';
				}
			}
			if(sel == 'equipoD'){
				if(equipo==b || equipo == c || equipo == a){
					alert(equipo + ' Ya ha sido seleccionado');
					document.getElementById("equipoD").value='';
					document.getElementById("equipoD").text='';
				}
			}

		}


		$( document ).ready(function() {
			document.getElementById("equipoA").value='';
			document.getElementById("equipoA").text='';
			document.getElementById("equipoB").value='';
			document.getElementById("equipoB").text='';
			document.getElementById("equipoC").value='';
			document.getElementById("equipoC").text='';
			document.getElementById("equipoD").value='';
			document.getElementById("equipoD").text='';
		});


	</script>
