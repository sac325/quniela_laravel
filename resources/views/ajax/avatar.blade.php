<div class="modal fade" id="modalavatar">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Editar Datos</h5>
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
        {!! Form::open(['route' => 'home.store', 'files' => true, 'method' => 'post', 'name'=>'avform', 'id'=>'avForm']) !!}
        {!! Form::hidden('id','',['class' => 'form-control', 'id'=>'id']) !!}
        {!! Form::text('name','',['class' => 'form-control', 'id'=>'name']) !!}
        <br>
        {!! Form::file('image') !!} 
        <br>
        {!! Form::submit('Click Me!') !!} 
        {!! Form::close() !!}
      </div>
  </div>
</div>
</div>