@extends('layouts.app')

@section('content')


<div class="container">

    @foreach($data as $dt)
    
    <div class="panel panel-default" id="{!! $dt->id_apuesta!!}">
        <div class="panel-heading" id="panel-heading{!! $dt->id_apuesta!!}" style="{!! $dt->styl!!}"><div class="row">
            <div class="col-md-2">
            <input type="hidden"  id="" value="">
            <h5 class="text-center border-bottom border-gray pb-2" id="texto{!! $dt->id_apuesta!!}">El partido comienza en: </h5>
        </div>
        <div class="col-md-2">
        <p id="partido{!! $dt->id_apuesta!!}" data-countdown="{{$dt->fecha}} {{$dt->hora}}"></p>
        </div>
        <div class="col-xs-4">
            <h5 class="text-center border-bottom border-gray pb-2">Grupo: {{$dt->grupo}}</h5>
        </div>
        <div class="col-xs-4">
            <h5 class="text-center border-bottom border-gray pb-2">{{$dt->fase}}</h5>
        </div>
    </div></div>
    <div class="panel-body">

        <div class="row">
            <div class="col-md-1 text-center"></div>
            <div class="col-md-1 text-center"><?php echo "<img style='height: 50px;' src=' " . asset("storage/upload/" . $dt->img_equipo1 ) ."'> "; ?> </div>
            <div class="col-md-1 text-center"><h3 class="text-center">  {{$dt->equipo1}}</h3> </div>
            <div class="col-md-2 text-center"><input type="number" id="goles1a" name="goles1a" min="0" max="9"  value="{{$dt->goles1a}}"> </div>
            <div class="col-md-2 text-center"><h3 class="text-center pb-2">Vs</h3></div>
            <div class="col-md-2 text-center"><input type="number" id="goles2a" name="goles2a" min="0" max="9" value="{{$dt->goles2a}}"> </div>
            <div class="col-md-1 text-center"><h3 class="text-center">{{$dt->equipo2}}</h3></div>
            <div class="col-md-1 text-center"><?php echo "<img style='height: 50px;' src=' " . asset("storage/upload/" . $dt->img_equipo2 ) ."'> "; ?></div>
            <div class="col-md-1 text-center"></div>

        </div>
        <div class="row">
            <div class="col-xs-4"><h5 class="text-center border-bottom border-gray pb-2">{{$dt->stadium}} / {{$dt->ciudad}}</h5></div>
            <div class="col-xs-4 text-center"><h5 class="text-center border-bottom border-gray pb-2"><span id="resultadoa{!! $dt->id_apuesta!!}">{{$dt->resultadoa}}</span></h5>
            <button id="button{!! $dt->id_apuesta!!}" class="btn btn-xs btn-info" onclick="editar('{!! $dt->id_apuesta!!}')" style="{!! $dt->disbtn!!}" >Actualizar
            </button></div>
            <div class="col-xs-4"><h5 class="text-center border-bottom border-gray pb-2"><span>{{$dt->fecha}} / </span><span id="hora{!! $dt->id_apuesta!!}" data-hora="{{$dt->fecha}} {{$dt->hora}}">{{$dt->hora}}</span></h5></div>
        </div>

    </div>
    
</div>
    

    @endforeach
</div>




@endsection
@section('script')
@endsection
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

<script>

$(document).ready(function(){

    $("[data-hora]").each(function() {
        var id = $(this).attr("id");
        var hora = $(this).attr("data-hora");
        var countDownHora = new Date(hora).getHours();
        var d = new Date();
        var n = d.getTimezoneOffset();
        var t = (n / 60);

        horaNw= countDownHora - t;
        document.getElementById(id).innerHTML = horaNw + ":00";
    });
    $("[data-countdown]").each(function() {
        var id = $(this).attr("id");
        var textoe = id.replace("partido","texto");
        var fecha_cun = $(this).attr("data-countdown");
        var countDownDate = new Date(fecha_cun).getTime();

var x = setInterval(function() {

// Get todays date and time
var now = new Date().getTime();
var d = new Date();
var n = d.getTimezoneOffset();
var t = now + (n*1000 * 60);
// Find the distance between now an the count down date
var distance = countDownDate - t;

// Time calculations for days, hours, minutes and seconds
var days = Math.floor(distance / (1000 * 60 * 60 * 24));
var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
var seconds = Math.floor((distance % (1000 * 60)) / 1000);

// Output the result in an element with id="demo"
document.getElementById(id).innerHTML = days + "d " + hours + "h "
+ minutes + "m " + seconds + "s ";

// If the count down is over, write some text 
if (distance < 0) {
    clearInterval(x);
    document.getElementById(id).innerHTML = "";
    document.getElementById(textoe).innerHTML = "";
}
}, 1000);




  });
 
});


    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
        });

        function editar(id){
            $('#button'+id).prop('disabled', true);
            var div = $('#'+id);
            var a =  div.find(':input[id^="goles1a"]').val();
            var b =  div.find(':input[id^="goles2a"]').val();
            console.log(a + ' ' + b);
            // var a = document.getElementById("goles1").value;
            // var b = document.getElementById("goles2").value;

           $.get("{!! URL::to('apuesta2/edit') !!}",{id:id,a:a,b:b}, function(data){
            
                console.log(data);
                if(data.resultado){
                    $('#resultadoa'+id).text(data.resultado);
                    $('#panel-heading'+id).css({'background': '#ffffff url(storage/upload/bg_blue.png)','color': 'white'});
                }
                else
                console.log(data.mensaje);

                $('#button'+id).prop('disabled', false);
            });
       }



    </script>
  

