<div class="modal fade" id="modalEquipos">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Editar Equipo</h5>
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
      {!! Form::open(['route' => 'equipo.update', 'files' => true, 'method' => 'post', 'name'=>'eqformed', 'id'=>'eqFormed']) !!}
      {!! Form::hidden('id_equipo','',['class' => 'form-control', 'id'=>'id_equipo']) !!}
      {!! Form::text('equipo','',['class' => 'form-control', 'id'=>'equipo']) !!}  
         {!! Form::file('image') !!} 
       <hr>     
      {!! Form::submit('Guardar',['class' => 'btn btn-primary']) !!} 
      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      {!! Form::close() !!}
    </div>
  </div>
</div>
</div>