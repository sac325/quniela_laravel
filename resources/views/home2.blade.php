@extends('layouts.app')

@section('content')
@include('ajax.apuestasConsulta')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
            <div class="row">
                    <div class="col-sm-3"></div>
                        <div class="col-sm-8"><h1>Fase de Eliminatorias</h1></div>
                        <div class="col-sm-1"></div>
                    </div>
                <div class="panel-heading">
                    
                    <div class="row">
                        <div class="col-sm-4">POSICIÓN</div>
                        <div class="col-sm-4">PARTICIPANTE</div>
                        <div class="col-sm-4">PUNTUACIÓN</div>
                    </div>
                </div>

                <div class="panel-body" id='panelbody'>


                </div>
            </div>
        </div>
    </div>
</div>


@endsection
@section('script')
@endsection
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script type="text/javascript">
  $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
        });
 
 onload = function(){

     $.get("{!! URL::to('home/showb') !!}",null, function(data){
			
            $('div#panelbody').empty();
            $('div#panelbody').append($('<ul class="list-group">'));
    var i = 1;
    $.each(data, function(index, item) {
        if (item.imagen == null ){
    item.imagen ='avatar_circle_blue.png';
    }
    var imagen = "{!! asset('storage/upload/"+ item.imagen + "'); !!}";
    
   
          $('div#panelbody').append(
          $('<li class="list-group-item"><div class="row"><div class="col-sm-3"><span class="align-middle">' + i + '</span></div>' + 
            '<div class="col-sm-2"><img id="'+item.id +'" style= "cursor: pointer;" onclick="consultar(this.id);" class="avatar"  src="'+ imagen +'" ></img></div><div class="col-sm-4"> <span class="align-middle"> '+item.name +'</span></div> '+
            '<div class="col-sm-3"><span class="align-middle">'+ item.puntaje+'</span></div></div> </li>'
               
               )
          );
    
    
            i=i+1;
        });
    $('div#panelbody').append($('</ul>'));
         });

       
 }


 function consultar(id){

$.get("{!! URL::to('home/edit') !!}",{id:id}, function(data){
    $('span#participante').empty();
    console.log(data);
    //$('span#participante').append(data[0].nombre);
    $('div#modalbody').empty();
    $('div#modalbody').append($('<ul class="list-group">'));
  
 $.each(data, function(index, item) {
if(item.fase=='Fase 2'){
    var imgequipo1 = "{!! asset('storage/upload/"+ item.img_equipo1 + "'); !!}";
    var imgequipo2 = "{!! asset('storage/upload/"+ item.img_equipo2 + "'); !!}";

   var eq =  item.id_equipo;
   $('div#modalbody').append(
         $('<li class="list-group-item"><div class="row">'+
         '<div class="col-sm-1 text-center"><img style="height: 28px;" src="'+ imgequipo1 +'" ></img></div>' +
         '<div class="col-sm-2 text-center">'+ item.equipo1+'</div>' +
         '<div class="col-sm-1 text-center">'+ item.goles1a+'</div>' +
         '<div class="col-sm-1 text-center">-</div>' +
         '<div class="col-sm-1 text-center">'+ item.goles2a+'</div>' +
         '<div class="col-sm-2 text-center">'+ item.equipo2+'</div>' +
         '<div class="col-sm-3 text-center"><img style="height: 28px;" src="'+ imgequipo2 +'" ></img></div>' +
         '<div class="col-sm-1 text-center"> <span class="badge badge-primary badge-pill">'+ item.puntajea+'</span></div>'+
         '</div></li>')
         );
}
   
  });    
  $('div#modalbody').append($('</ul>'));
  $("#modalApuestaConsulta").modal();
});





}

</script>
