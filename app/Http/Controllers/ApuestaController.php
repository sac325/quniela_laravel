<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Apuesta;
use Illuminate\Http\Request;
use App\Partido;
use DateTime;

class ApuestaController extends Controller
{

     public function __construct()
    {
        $this->middleware('auth:admin,web');
    }
    /**
     * Display a listing of the resource. 
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $id = Auth::id();
         $data = DB::table('apuestasvw')->select('*')->where([['id_user','=',$id],['fase','=','Fase 1']])->get();
     // $data= Grupo::get();
     
     foreach($data as $dat){
        $partido = Partido::find($dat->id_partido);
        $fecha_partido=$partido->fecha . " " . $partido->hora;
        $fc = strtotime($fecha_partido);
        
        $dt = new DateTime($fecha_partido);
        $dtnow = new DateTime();
         
         
             $intervalo = $dt->diff($dtnow);
         $int = $intervalo->format('%H');
         if($dt < $dtnow){
            $dat->{'styl'}='background: #b81319 url(storage/upload/bg_red.jpg);  color: white;';
            $dat->{'disbtn'}='visibility: hidden;';
            
            
         }else{
             
           /* if($dt->format("Y-m-d") == $dtnow->format("Y-m-d") && $intervalo->format('%H') == '00'){
                $dat->{'styl'}='#b81319 url(storage/upload/bg_red.jpg);   color: white;';
                $dat->{'disbtn'}='visibility: hidden;';
                
            } 	else{*/
                if($dat->resultadoa=='-'){
                    $dat->{'styl'}='background: #ffffff url(storage/upload/bg.jpg);';
                    $dat->{'disbtn'}='';
                }else{
                    $dat->{'styl'}='background: #ffffff url(storage/upload/bg_blue.png); color: white;';
                    $dat->{'disbtn'}='';
                }

        //}
        }
     }
     
     
      return view('apuesta')->with('data', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Apuesta  $apuesta
     * @return \Illuminate\Http\Response
     */
    public function show(Apuesta $apuesta)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Apuesta  $apuesta
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {

       

          if($request->ajax()){
             $id = Auth::id();
         $data = DB::table('apuestasvw')->select('*')->where([
                    ['id_user', '=', $id],
                    ['id_apuesta', '=', $request->id],['fase','=','Fase 1']
                ])->get();
          // $apuesta = new Apuesta();
    $partido = Partido::find($data[0]->id_partido);
    $fecha_partido=$partido->fecha . " " . $partido->hora;
	$fc = strtotime($fecha_partido);
	
	$dt = new DateTime($fecha_partido);
	$dtnow = new DateTime();
 	
 	
 		$intervalo = $dt->diff($dtnow);
 	$int = $intervalo->format('%H');
 	if($dt < $dtnow){
        $apuesta['mensaje']= "Fecha Pasada, Te la tiras de viv@";
        return response($apuesta);
 	}else{
 		/*
		if($dt->format("Y-m-d") == $dtnow->format("Y-m-d") && $intervalo->format('%H') == '00'){
            $apuesta['mensaje']= "se acabo el tiempo, Te la tiras de viv@";
            return response($apuesta);
		} 	else{*/
		
            $apuesta = Apuesta::find($request->id);

            if ($request->a >=0 && $request->b>=0) {
            
            $apuesta->goles1=$request->a;
            $apuesta->goles2=$request->b;
            
                if($request->a>$request->b){
                /*validar que no se cambio manualmente el equipo en la página*/

                $apuesta->resultado = $data[0]->equipo1;

            }elseif($request->a<$request->b){

                $apuesta->resultado = $data[0]->equipo2;

            }else {

                $apuesta->resultado = 'Empate';
            }

                $apuesta->save();
            }else{
                
                $apuesta->goles1=0;
                $apuesta->goles2=0;
                $apuesta->resultado = '-';
                $apuesta->save();
            }
            
            $data2 = DB::table('apuestasvw')->select('*')->where([
                    ['id_user', '=', $id],
                    ['id_apuesta', '=', $request->id],['fase','=','Fase 1']
                ])->get();


            return response($apuesta);
          //}
        }
        }     

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Apuesta  $apuesta
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Apuesta $apuesta)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Apuesta  $apuesta
     * @return \Illuminate\Http\Response
     */
    public function destroy(Apuesta $apuesta)
    {
        //
    }
}
