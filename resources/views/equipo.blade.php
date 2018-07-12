@extends('layouts.app')

@section('content')
@include('ajax.updateEquipo')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Ingrese Los Equipos</div>

                <div class="panel-body">
				@if ($errors->any())
					<div class="alert alert-danger">
					<ul>
						@foreach ($errors->all() as $error)
							<li>{{ $error }}</li>
						@endforeach
					</ul>
					</div>
				@endif
				{!! Form::open(['route' => 'equipo.index', 'files' => true, 'method' => 'post', 'name'=>'eqform', 'id'=>'eqForm']) !!}
				 {!! Form::text('equipo_ins','',['class' => 'form-control', 'id'=>'equipo_ins']) !!}
				 {!! Form::file('image') !!} 
				{!! Form::submit('Guardar',['class' => 'btn btn-primary']) !!} 
				{!! Form::close() !!}
                </div>
				
				<div class="panel-heading">Equipos Ingresados</div>

                <div class="panel-body">
							
				<table class="table table-striped table-bordered table-hover">
					<thead>
					<tr>
					<th width="20%"></th>
					<th width="40%"> País</th>
					<th width="40%"> Bandera </th>
          
					</tr>
					</thead>
					<tbody>
					@foreach($data as $dt)
					<tr class="odd gradeX"  id="{!! $dt->id_equipo!!}">
					<td> <button class="btn btn-info btn-xs" onclick="editar('{!! $dt->id_equipo!!}')" id="editar" >Editar</button>
					<button class="btn btn-danger btn-xs" onclick="eliminar('{!! $dt->id_equipo!!}')" id="eliminar" > Eliminar </button></td>
					<td> <p class="text-center"> {{$dt->equipo}} </p></td>
					<td> <img src="{{ asset('storage/upload/'.$dt->description) }}" class="center-block" height="28" width="42"> </td>
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
		
		$.get("{!! URL::to('equipo/edit') !!}",{id:id}, function(data){
			$('#id_equipo').val(data[0].id_equipo)
			$('#equipo').val(data[0].equipo)
			console.log(data);
			$("#modalEquipos").modal();
		});
	}

	function eliminar(id){
		console.log(id);

		$.post("{!! URL::to('equipo/destroy') !!}",{id:id}, function(data){
			$('tr#' + id).remove();
			console.log(data);
			
		});
	}

	$( document ).ready(function() {
    document.getElementById("equipo_ins").value= '';
});


</script>

