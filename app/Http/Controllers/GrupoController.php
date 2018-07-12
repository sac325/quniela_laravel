<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Grupo;
use App\ImagenGrupo;
use Illuminate\Http\Request;

class GrupoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data = DB::table('agrupacion')->select('*')->get();
     // $data= Grupo::get();

      return view('grupo')->with('data', $data);
  }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       $data = DB::table('equipos')->select('*')->get();


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
        'grupo' => 'required|unique:imagen_grupos,grupo',
        'equipoA' => 'required',
        'equipoB' => 'required',
        'equipoC' => 'required',
        'equipoD' => 'required',
        'image' => 'required',
    ]);
      
      $imagengrupo = new ImagenGrupo;

      $imagengrupo->description = $request->image->getClientOriginalName();            
      $imagengrupo->image_size = $request->image->getClientSize(); 
      $imagengrupo->content_type = $request->image->getClientMimeType();
      $request->image->storeAs('public/upload',$imagengrupo->description);  // no borrar mklink /j /path/to/laravel/public/avatars /path/to/laravel/storage/avatars 
      $imagengrupo->grupo = $request->grupo;
      $imagengrupo->save();
      $idgrp = $imagengrupo->id;
     
      $equipos[0] = ['equipo'=> $request->equipoA ];
      $equipos[1] = ['equipo'=> $request->equipoB ];
      $equipos[2] = ['equipo'=> $request->equipoC ];
      $equipos[3] = ['equipo'=> $request->equipoD ];
      
      for ($i=0; $i < 4; $i++) { 
        $grupo = new Grupo;
          $grupo->grupo = $idgrp;
          $grupo->id_equipo = $equipos[$i]['equipo'];

           $grupo->save();
       }
       //$data = DB::table('grupos')->select('*')->get();  modificar query con inner join

    $data = DB::table('agrupacion')->select('*')->get();
     // $data= Grupo::get();

      return view('grupo')->with('data', $data);

   }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Grupo  $Grupo
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        if($request->ajax()){

            $data = DB::table('agrupacion')->select('*')->where('id_grupo',$request->id)->get();

            return response($data);

        }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Grupo  $Grupo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Grupo  $Grupo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        if($request->ajax()){

          //  Grupo::destroy($request->id);

            return response(['message'=>'Grupo eliminado satisfactoriamente']);

        }    
    }
}
