<div class="modal fade" id="modalEquiposInsert">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Ingrese Equipo</h5>
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
        {!! Form::open(['route' => 'equipo.index', 'files' => true, 'method' => 'post', 'name'=>'eqform', 'id'=>'eqForm']) !!}
                 {!! Form::text('equipo','',['class' => 'form-control', 'id'=>'equipo']) !!}
         {!! Form::file('image') !!} 
         {!! Form::submit('Click Me!') !!} 
        {!! Form::close() !!}
      </div>
    </div>
  </div>
</div>