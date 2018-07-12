@extends('layouts.app')

@section('content')
<div class="py-4" >
  <div class="container"  style="background: #0f4583 url(storage/upload/fwc_darkbluebg.png) repeat;">
    <div class="row">
      <div class="col-md-12">
        <h2 style="color: white;">Grupos</h2>
        <hr> </div>
      </div>
      <div class="row text-center">
        <div class="col-md-3">
         <?php echo "<img id='a' style= 'cursor: pointer;' onclick='consultar(this.id);'  src=' " . asset("storage/upload/grupoa.png") ."'> "; ?>
       </div>
       <div class="col-md-3">
         <?php echo "<img id='b' style= 'cursor: pointer;' onclick='consultar(this.id);'  src=' " . asset("storage/upload/grupob.png") ."'> "; ?>

       </div>
       <div class="col-md-3">
        <?php echo "<img id='c' style= 'cursor: pointer;' onclick='consultar(this.id);'  src=' " . asset("storage/upload/grupoc.png") ."'> "; ?> 
      </div>

      <div class="col-md-3">
        <?php echo "<img id='d' style= 'cursor: pointer;' onclick='consultar(this.id);'  src=' " . asset("storage/upload/grupod.png") ."'> "; ?>
      </div>
    </div>
    <div class="row text-center">
      <div class="col-md-3">
       <?php echo "<img id='e' style= 'cursor: pointer;' onclick='consultar(this.id);'  src=' " . asset("storage/upload/grupoe.png") ."'> "; ?>
     </div>
     <div class="col-md-3">
       <?php echo "<img id='f' style= 'cursor: pointer;' onclick='consultar(this.id);'  src=' " . asset("storage/upload/grupof.png") ."'> "; ?>

     </div>
     <div class="col-md-3">
      <?php echo "<img id='g' style= 'cursor: pointer;' onclick='consultar(this.id);'  src=' " . asset("storage/upload/grupog.png") ."'> "; ?> 
    </div>

    <div class="col-md-3">
      <?php echo "<img id='h' style= 'cursor: pointer;' onclick='consultar(this.id);'  src=' " . asset("storage/upload/grupoh.png") ."'> "; ?>
    </div>
  </div>

</div>
<div class="container">
  <div class="row">
    <div class="col-12">
      <h2 >Posiciones</h2>
      <hr class="mb-4"> </div>
    </div>
    <div class="row">

      <div class="col-md-6 p-3" id="posiciones">
        <table class="table table-hover table-striped table-bordered">
          <thead class="thead-inverse">
            <tr>
              <th scope="col">Equipos</th>
              <th scope="col">PJ</th>
              <th scope="col">G</th>
              <th scope="col">E</th>
              <th scope="col">P</th>
              <th scope="col">GF</th>
              <th scope="col">GC</th>
              <th scope="col">+/-</th>
              <th scope="col">Pts</th>
            </tr>
          </thead>
          <tbody id="tabla">

          </tbody>
        </table>
      </div>
      <div class="col-md-6 p-3">
        <div  class="list-group" >
         <table class="table table-hover table-striped table-bordered" id="partidos">
          <col width="15%"><col width="15%"><col width="5%"><col width="15%"><col width="15%">
          <col width="35%">
          <tbody id="partidos">

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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script type="text/javascript">
  $( document ).ready(function() {
    


  });
  function cargapartidos(id){

    $.get("{!! URL::to('grupoPicture/showp') !!}",{id:id}, function(data){

      $('tbody#partidos').empty();

      $.each(data, function(index, item) {
        var imagen1 = "{!! asset('storage/upload/"+ item.img_equipo1 + "'); !!}";
         var imagen2 = "{!! asset('storage/upload/"+ item.img_equipo2 + "'); !!}";
        $('tbody#partidos').append(
          $('<tr><td><img src="'+imagen1+'" ></img></td><td> '+item.equipo1 + '</td><td> VS </td><td>'+item.equipo2 + '</td><td> <img src="'+ imagen2 +'" ></img></td>'+
          '<td>' + item.goles1+' - ' + item.goles2+' / ' + item.fecha+' ' + item.hora+'</td></tr>')

          );
        console.log(item);

      });
    });
  }


  function consultar(id){

    $.get("{!! URL::to('grupoPicture/show') !!}",{id:id}, function(data){

      $('tbody').empty();

      $.each(data, function(index, item) {

        var imagen = "{!! asset('storage/upload/"+ item.description + "'); !!}";

        var eq =  item.id_equipo;
        $('tbody#tabla').append(
            // $('<img></img>').src(item.description);
            $('<tr style= "cursor: pointer;" id="'+eq+'" onclick="cargapartidos(this.id);"><td><img  src="'+ imagen +'" ></img><strong> '+item.equipo +'</strong> </td>'+
              '<td>'+ item.jugados+'</td>'+
              '<td>'+ item.ganados+'</td>'+
              '<td>'+ item.empatados+'</td>'+
              '<td>'+ item.perdidos+'</td>'+
              '<td>'+ item.golesfavor+'</td>'+
              '<td>'+ item.golescontra+'</td>'+
              '<td>'+ item.diff +'</td>'+
              '<td>'+ item.puntaje+'</td></tr>')
            );



        console.log(item.description);
      });     
    });
  }


</script>
