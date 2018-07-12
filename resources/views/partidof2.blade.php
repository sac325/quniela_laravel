@extends('layouts.app')

@section('content')
@include('ajax.updatePartido2')
@include('ajax.insertPartidof2')

<div class="container">
	@if (Auth::check())
	@can('administrador',Auth::user())
	<button type="button" class="btn btn-primary btn-s" onclick="crear();">Insertar Partido</button>
	@endcan
	@endif
	@foreach($data as $dt)
	
	<div class="panel panel-default">
		<div class="panel-heading"><div class="row">
			<div class="col-md-4">
				@if (Auth::check())
				@can('administrador',Auth::user())
				<button class="btn btn-xs btn-info" onclick="editar('{!! $dt->id_partido!!}')" id="editar" >Editar
				</button>
				
				<button class="btn btn-xs btn-danger" onclick="eliminar('{!! $dt->id_partido!!}')" id="eliminar" > Eliminar </button>
				@endcan
				@endif
			</div>
			<div class="col-xs-4">
				<h5 class="text-center border-bottom border-gray pb-2">Instancia: {{$dt->grupo}}</h3>
				</div>
				<div class="col-xs-4">
					<h5 class="text-center border-bottom border-gray pb-2">{{$dt->fase}}</h3>
					</div>
				</div></div>
				<div class="panel-body">

					<div class="row">
						<div class="col-md-1 text-center"></div>
						<div class="col-md-1 text-center"><?php echo "<img style='height: 50px;' src=' " . asset("storage/upload/" . $dt->img_equipo1 ) ."'> "; ?></div>
						<div class="col-md-1 text-center"><h3 class="text-center">  {{$dt->equipo1}}</h3> </div>
						<div class="col-md-2 text-center"><h3 class="text-center border border-gray pb-2">{{$dt->goles1}}</h3> </div>
						<div class="col-md-2 text-center"><h3 class="text-center pb-2">Vs</h3></div>
						<div class="col-md-2 text-center"><h3 class="text-center border border-gray pb-2">{{$dt->goles2}}</h3> </div>
						<div class="col-md-1 text-center"><h3 class="text-center">{{$dt->equipo2}}</h3></div>
						<div class="col-md-1 text-center"><?php echo "<img style='height: 50px;' src=' " . asset("storage/upload/" . $dt->img_equipo2 ) ."'> "; ?></div>
						<div class="col-md-1 text-center"></div>

					</div>
					<div class="row">
						<div class="col-xs-4"><h5 class="text-center border-bottom border-gray pb-2">{{$dt->stadium}} / {{$dt->ciudad}}</h5></div>
						<div class="col-xs-4 text-center"><h5 class="text-center border-bottom border-gray pb-2">{{$dt->resultado}}</h5></div>
						<div class="col-xs-4"><h5 class="text-center border-bottom border-gray pb-2">{{$dt->fecha}} / {{$dt->hora}}</h5></div>
					</div>

				</div>
			</div>

			@endforeach

		</div>

		@endsection
	@section('script')
	@endsection
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
		<script type="text/javascript">
		 function form_submit() {
    document.getElementById("prFormup").submit();
   } 
			$.ajaxSetup({
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				}

			});
			function editar(id){

				$.get("{!! URL::to('partido2/edit') !!}",{id:id}, function(data){

					
					
			 document.getElementById("id_partidoup").value=data.id;
			 console.log(data.id);
			//$('#partido').val(data[0].partido)
			
			$("#modalPartidoUp2").modal();
		});
			}
		function crear(){
				document.getElementById("equipo1").value='';
				document.getElementById("equipo1").text='';
				document.getElementById("equipo2").value='';
				document.getElementById("equipo2").text='';
				document.getElementById("grupo").value='';
				document.getElementById("grupo").text='';
				document.getElementById("fasea").value='';
				document.getElementById("fasea").text='';

				document.getElementById("ciudad").text='';
				document.getElementById("estadio").text='';
				document.getElementById("fecha").text='';
				document.getElementById("hora").text='';	

				$.get("{!! URL::to('partido2/create') !!}",null, function(data){
		//	$('#id_partido').val(data[0].id_partido)
		//	$('#partido').val(data[0].partido)
		//console.log(data);


		cargarequipos();


		$("#modalPartidof2").modal();



	});
			}
			function cargarequipos(){
				//var id = document.getElementById("grupo1").value;
		//		console.log(id);
			
				$("#equipo1").append( 
					$("<option></option>") 
					.text("")
					.val(""));
				$("#equipo2").append( 
					$("<option></option>")  
					.text("")
					.val(""));
					$("#grupo").append( 
					$("<option></option>")  
					.text("")
					.val(""));
				$.get("{!! URL::to('partido2/selpartido') !!}",null, function(data){
					console.log(data['grupos']);
					$.each(data['equipos'], function(index, item) {
						$("#equipo1").append( 
							$("<option></option>") 
							.text(item.equipo)
							.val(item.id_equipo));
						$("#equipo2").append( 
							$("<option></option>") 
							.text(item.equipo)
							.val(item.id_equipo));
					
						
					//	console.log(item.equipo);
					});
					$.each(data['grupos'], function(index, item) {
						
						$("#grupo").append( 
							$("<option></option>") 
							.text(item.grupo)
							.val(item.id_grupo));
						
					//	console.log(item.equipo);
					});

				});
			}

			function eliminar(id){
			//	console.log(id);

				$.post("{!! URL::to('partido2/destroy') !!}",{id:id}, function(data){
					$('tr#' + id).remove();
			//		console.log(data);

				});
			}
		function revisargrupo(){ // para revisar que el partido que se está colocando es del mismo grupo

		}
		function revisarpartido(equipo, sel){
			var a = document.getElementById("equipo1").value;
			var b = document.getElementById("equipo2").value;
			

			if(sel == 'equipo1'){
				if(equipo==b){
					alert(equipo + ' Ya ha sido seleccionado');
					document.getElementById("equipo1").value='';
					document.getElementById("equipo1").text='';
				}
			}
			if(sel == 'equipo2'){
				if(equipo==a){
					
					alert(equipo + ' Ya ha sido seleccionado');
					document.getElementById("equipo2").value='';
					document.getElementById("equipo2").text='';
				}
			}

		}


		$( document ).ready(function() {
			document.getElementById("equipo1").value='';
			document.getElementById("equipo1").text='';
			document.getElementById("equipo2").value='';
			document.getElementById("equipo2").text='';
			
			document.getElementById("fasea").value='';
			document.getElementById("fasea").text='';

			document.getElementById("ciudad").text='';
			document.getElementById("estadio").text='';
			document.getElementById("fecha").text='';
			document.getElementById("hora").text='';			
		});


	</script>
