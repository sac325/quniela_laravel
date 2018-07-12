<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

use DateTime;
use App\Partido;
use App\User;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        
        $this->middleware('auth:admin,web');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return view('home');
    }
    public function indexb()
    {

        return view('home2');
    }
    public function show(){
        $id = Auth::id();
        $user= DB::table('users')->select('*')->where('id','=',$id)->get();
        $data = DB::table('posiciones')
        ->select('*')
        ->where('posiciones.id_licencia','=',$user[0]->id_licencia)->orderBy('puntaje','desc')
        ->get();
        return response($data);
    }
    public function showb(){
        $id = Auth::id();
        $user= DB::table('users')->select('*')->where('id','=',$id)->get();
        $data = DB::table('posiciones2')
        ->select('*')
        ->where('posiciones2.id_licencia','=',$user[0]->id_licencia)->orderBy('puntaje','desc')
        ->get();
        return response($data);
    }
    public function showtotal(){
        $id = Auth::id();
        $user= DB::table('users')->select('*')->where('id','=',$id)->get();
        $data = DB::table('posiciones')
        ->select('*')
        ->where('posiciones.id_licencia','=',$user[0]->id_licencia)->orderBy('puntaje','DESC')
        ->get();
        return response($data);
    }


   public function edit(Request $request){

    if($request->ajax()){
        $id = Auth::id();
        
        if($id == $request->id){
        $data = DB::table('apuestasvw')->select('*')->where('apuestasvw.id_user','=',$request->id)->orderBy('id_apuesta')->get();
        
        return response($data);

        }else{
            $data = DB::table('apuestasvw')->select('*')->where('apuestasvw.id_user','=',$request->id)->orderBy('id_apuesta')->get();        //$data['mensaje'] ='pasa por else';
        
        
        //$user= DB::table('users')->select('*')->where('id','=',$id)->get();

        foreach($data as $key => $dat){
            $partido = Partido::find($dat->id_partido);
            $fecha_partido=$partido->fecha . " " . $partido->hora;
            $fc = strtotime($fecha_partido);
            
            $dt = new DateTime($fecha_partido);
            $dtnow = new DateTime();
             
             
                 $intervalo = $dt->diff($dtnow);
             $int = $intervalo->format('%H');
             if($dt < $dtnow){
                //dejar
                
                
             }else{
                 
               // if($dt->format("Y-m-d") == $dtnow->format("Y-m-d") && $intervalo->format('%H') == '00'){
                    //dejar
               // } 	else{
                    //quitar
                    unset($data[$key]);
            //}
            }
         }
       return response($data);
        }
    }
    }

    public function update()
    {
    $id = Auth::id();
    $user = User::find($id);

     return response($user);
      
  }

  public function store(Request $request)
    {
      
      $request->validate([
        'id' => 'required|numeric',
        'name' => 'required|max:100|min:3',
        
    ]);
      $user = User::find($request->id);
			//$imgdt = $request->$image;
			//$id = DB::table('equipos')->insertGetId(['image_data' => $imgdt]);
      if($request->image)
      {
        $user->imagen = $request->image->getClientOriginalName();			
        $request->image->storeAs('public/upload',$user->imagen);
      }
   
      $user->name = $request->name;
      $user->save();
      
      
     // $this->index();

        return $this->index();
      
  }


}
