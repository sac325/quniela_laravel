<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Partido;
use App\Grupo;
use App\Apuesta;
use Illuminate\Http\Request;

class PartidoControllerb extends Controller
{

     public function __construct()
    {
        $this->middleware('auth:admin,web,api');
       //$this->middleware('auth:admin');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $data = DB::table('partidosvw2')->select('*')->where('fase','=','Fase 2')->get();
     // $data= Grupo::get();

      return view('partidof2')->with('data', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data[0] = DB::table('equipos')->select('*')->get();
        $data[1] = DB::table('imagen_grupos')->select('*')->get();


       return response($data);
    }
    public function selpartido(Request $request)
    {
        $data['equipos'] = DB::table('equipos')
            ->select('equipos.*')
            ->get();
        $data['grupos'] = DB::table('imagen_grupos')->select('*')->get();
       


       return response($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
        'equipo1' => 'required',
        'equipo2' => 'required',
        'fasea' => 'required',
        'ciudad' => 'required',
        'estadio' => 'required',
        'fecha' => 'required',
        'hora' => 'required',

    ]);

        $partido = new Partido;
        $partido->id_grupo = $request->grupo;
        $partido->id_equipo1  = $request->equipo1;
        $partido->id_equipo2 = $request->equipo2;
        $partido->hora = $request->hora;
        $partido->fecha = $request->fecha;
        $partido->ciudad = $request->ciudad;
        $partido->stadium = $request->estadio;
        $partido->fase  = $request->fasea;
        $partido->save();
    $data = DB::table('partidosvw2')->select('*')->where('fase','=','Fase 2')->get();
     // $data= Grupo::get();

      return view('partidof2')->with('data', $data);


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\partido  $partido
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        // mostrar los partidos en ionic
        
        $data = DB::table('partidosvw2')->select('*')->where('fase','=','Fase 2')->get();
           
        return response($data);
       
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\partido  $partido
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $partido = Partido::find($request->id);
        return response($partido);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\partido  $partido
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //
        $data = DB::table('partidosvw2')
        ->select('*')
        ->where([['partidosvw2.id_partido',  '=', $request->id_partidoup],['fase','=','Fase 2']])
        ->get();
        $partido = Partido::find($request->id_partidoup);

        $partido->goles1= $request->goles1;
        $partido->goles2= $request->goles2;
  
            if($request->goles1>$request->goles2){
                /*validar que no se cambio manualmente el equipo en la página*/

            $partido->resultado = $data[0]->equipo1;

            }elseif($request->goles1<$request->goles2){

                $partido->resultado = $data[0]->equipo2;

            }else {

                $partido->resultado = 'Empate';
            }

                $partido->save();
                $this->actualizaPuntuaciones();
               // $this->actualizaGrupo();
                $data2 = DB::table('partidosvw2')->select('*')->where('fase','=','Fase 2')->get();
                
                return view('partidof2')->with('data', $data2);

    }

    public function actualizaPuntuaciones(){

        
        $partidos = Partido::where([['resultado','<>','-'],['fase','=','Fase 2']])
        ->get();
        
        foreach($partidos as $partido){

        $apuestas = Apuesta::where('id_partido',$partido->id)
        ->get();
            
        foreach($apuestas as $apuesta){
            //pego resultado
            $puntaje=0;
            $diff1 = 0;
            $diff2 = 0;
            $goles1 = 0;
            $goles2 = 0;
            $puntaje_final = 0;
            if ($apuesta->resultado <> '-'){

if($partido->goles1 == $apuesta->goles1 && $partido->goles2 == $apuesta->goles2 && $partido->resultado == $apuesta->resultado){
                    $puntaje_final = 13;
                }else{
            if ($partido->goles1 > $apuesta->goles1){
                $diff1 = $partido->goles1 - $apuesta->goles1;
            }else if ($partido->goles1 < $apuesta->goles1){
                $diff1 = $apuesta->goles1 - $partido->goles1;
            }else{
                $diff1 = 0;
            }
            if ($partido->goles2 > $apuesta->goles2){
                $diff2 = $partido->goles2 - $apuesta->goles2;
            }else if ($partido->goles2 < $apuesta->goles2){
                $diff2 = $apuesta->goles2 - $partido->goles2;
            }else{
                $diff2 = 0;
            }
           
            
            if($partido->resultado == $apuesta->resultado)
            {
                $puntaje = 4;
            }

            //pego goles 1
            if($partido->goles1 == $apuesta->goles1)
            {
                $goles1 =  3;
            }
            else  if($partido->goles1 <> $apuesta->goles1) {
                
                $goles1 = 3 - $diff1; //3 - 1 = 2
                        

        }
             //pego goles 2
             if($partido->goles2 == $apuesta->goles2)
             {
                 $goles2 =  3;  

             }else if($partido->goles2 <> $apuesta->goles2){
                 $goles2 = 3 - $diff2; 
                 
            }
           $puntaje_final = $puntaje + $goles1 + $goles2;
                 if($puntaje_final < 0){
                     $puntaje_final = 0;
                 }
                }
                 $apuesta->puntaje = $puntaje_final;
            

                 $apuesta->save();
            }    
        }

        }
    }    

    public function actualizaGrupo(){

        $grupos = Grupo::all();


        foreach($grupos as $grupo){
        $ganados=0;
        $perdidos=0;
        $empatados=0;
        $puntaje=0;
        $golesF=0;
        $golesC=0;
        $jugados=0;
        $idpartido=[];
        $i=0;
        $partidos1 =  DB::table('partidosvw2')
        ->select('*')
        ->where([['partidosvw2.id_equipo1',  '=', $grupo->id_equipo],['resultado','<>','-']])
        ->get();
        foreach($partidos1 as $partido1){
            $idpartido[$i]=$partido1->id_partido;
            $golesF= $golesF + $partido1->goles1;
            $golesC= $golesC + $partido1->goles2;
            if($partido1->resultado == $partido1->equipo1){
                $ganados= $ganados + 1;
                $puntaje= $puntaje + 3;
            }
            if($partido1->resultado == $partido1->equipo1){
                $perdidos= $perdidos + 1;
            }
            if($partido1->resultado == 'Empate'){
                $empatados= $empatados + 1;
                $puntaje= $puntaje + 1;
            }
            
            $jugados= $jugados + 1;

        }
        $partidos2 =  DB::table('partidosvw2')
        ->select('*')
        ->where([['partidosvw2.id_equipo2',  '=', $grupo->id_equipo],['resultado','<>','-']])->get();
        foreach($partidos2 as $partido2){
            if (!in_array($partido2->id_partido, $idpartido)){

                $golesF= $golesF + $partido2->goles2;
                $golesC= $golesC + $partido2->goles1;
                if($partido2->resultado == $partido2->equipo2){
                    $ganados= $ganados + 1;
                    $puntaje= $puntaje + 3;
                }
                if($partido2->resultado == $partido2->equipo2){
                    $perdidos= $perdidos + 1;
                }
                if($partido2->resultado == 'Empate'){
                    $empatados= $empatados + 1;
                    $puntaje= $puntaje + 1;
                }
                
                $jugados= $jugados + 1;
            }
            
            
        }

        $grupo->ganados=$ganados;
        $grupo->perdidos=$perdidos;
        $grupo->empatados=$empatados;
        $grupo->puntaje=$puntaje;
        $grupo->golesfavor=$golesF;
        $grupo->golescontra=$golesC;
        $grupo->jugados=$jugados;
        $grupo->diff=$golesF - $golesC;

        $grupo->save();
        }

         

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\partido  $partido
     * @return \Illuminate\Http\Response
     */
    public function destroy(partido $partido)
    {
        //
    }
}
