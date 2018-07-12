<div class="modal fade" id="modalPartidoUp2">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Ingrese Los Partido</h5>
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
        
        {!! Form::open(['route' => 'partido2.update', 'files' => false, 'method' => 'post', 'name'=>'prFormup', 'id'=>'prFormup']) !!}
        <input type='hidden' id="id_partidoup" name="id_partidoup"> 
        <br>
        {!! Form::label('equipo1', 'equipo1')  !!}
        {!! Form::text('goles1','',['class' => 'form-control', 'id'=>'goles1']) !!}
        {!! Form::label('equipo2', 'equipo2')  !!}
        {!! Form::text('goles2','',['class' => 'form-control', 'id'=>'goles2']) !!}
     
        </div>
        
        <br>
        <button type="button" class="btn btn-primary" onclick="form_submit()">Actualizar</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

        {!! Form::close() !!}
        </div>
    </div>
  </div>
</div>