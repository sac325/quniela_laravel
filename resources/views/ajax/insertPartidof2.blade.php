<div class="modal fade" id="modalPartidof2">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Ingrese Los sfasffafdsfdsfsadfPartido</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				@if ($errors->any())
				<div class="alert alert-danger">
					<ul>
						@foreach ($errors->all() as $error)
						<li>{{ $error }}</li>
						@endforeach
					</ul>
				</div>
				@endif
				
				{!! Form::open(['route' => 'partido2.store', 'files' => false, 'method' => 'post', 'name'=>'grform', 'id'=>'grForm']) !!}
				
				<br>
				{!! Form::label('paises', 'Paises')  !!}
				<div>
					<select class="form-control" id="equipo1" name="equipo1" style="width: 45%; display: initial;">
						<option></option>
					</select>
					<select class="form-control" id="equipo2" name="equipo2" style="width: 45%; display: initial;">
						<option></option>
					</select>
					<br> 
					<select class="form-control" id="grupo" name="grupo" style="width: 45%; display: initial;">
						<option></option>
					</select>
					<br>
					<select class="form-control"  id="fasea" name="fasea" style="width: 24%; ">
						<option></option><option value="Fase 1">Fase 1</option><option value="Fase 2">Fase 2</option>
					</select>
					{!! Form::label('ciudad', 'Ciudad')  !!}
					{!! Form::text('ciudad','',['class' => 'form-control', 'id'=>'ciudad']) !!}
					{!! Form::label('estadio', 'Estadio')  !!}
					{!! Form::text('estadio','',['class' => 'form-control', 'id'=>'estadio']) !!}
					{!! Form::label('fecha', 'Fecha')  !!}
					<input id="fecha" name ="fecha" type="date" class="form-control">
					{!! Form::label('hora', 'Hora')  !!}
					<input id="hora" name ="hora" type="time" class="form-control">
				</div>
				
				<br>
				{!! Form::submit('Guardar',['class' => 'btn btn-primary']) !!} 
				{!! Form::close() !!}
			</div>
		</div>
	</div>
</div>