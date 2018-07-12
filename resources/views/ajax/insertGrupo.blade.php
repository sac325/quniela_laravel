<div class="modal fade" id="modalGrupos">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Ingrese Los Grupos</h5>
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
				
				{!! Form::open(['route' => 'grupo.store', 'files' => true, 'method' => 'post', 'name'=>'grform', 'id'=>'grForm']) !!}
				Seleccinar Grupo:
				<select class="form-control"  id="grupo" name="grupo" style="width: 24%; ">
					<option value="A">A</option><option value="B">B</option><option value="C">C</option><option value="D">D</option><option value="E">E</option><option value="F">F</option><option value="G">G</option><option value="H">H</option>
				</select>
				<br>
				Paises: 
				<div>
				<select class="form-control" onchange="revisargrupo(this.value, this.id);" id="equipoA" name="equipoA" style="width: 24%; display: initial;">
					<option></option>
				</select>
				<select class="form-control" onchange="revisargrupo(this.value, this.id);" id="equipoB" name="equipoB" style="width: 24%; display: initial;">
					<option></option>
				</select>
				<select class="form-control" onchange="revisargrupo(this.value, this.id);" id="equipoC" name="equipoC" style="width: 24%; display: initial;">
					<option></option>
				</select>
				<select class="form-control" onchange="revisargrupo(this.value, this.id);" id="equipoD" name="equipoD" style="width: 24%; display: initial;">
					<option></option>
				</select>
				</div>
				<br>
				Imagen de Grupo:
				{!! Form::file('image') !!} 
				<br>
				{!! Form::submit('Guardar',['class' => 'btn btn-primary']) !!} 
				{!! Form::close() !!}
        </div>
    </div>
  </div>
</div>