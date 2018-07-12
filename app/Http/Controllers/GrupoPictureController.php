<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\GrupoPicture;
use Illuminate\Http\Request;

class GrupoPictureController extends Controller
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
     return view('grupoPicture');
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
     * @param  \App\GrupoPicture  $grupoPicture
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $data = DB::table('equipos')
            ->join('grupos', 'equipos.id_equipo', '=', 'grupos.id_equipo')
            ->join('imagen_grupos', 'imagen_grupos.id_grupo', '=', 'grupos.grupo')
            ->select('*')
            ->where('imagen_grupos.grupo',  '=', $request->id)
            ->orderBy('grupos.puntaje', 'desc')
            ->orderBy('grupos.diff', 'desc')
            ->get();
       // $data = DB::table('equipos')->select('*')->get();
       


       return response($data);

    }
    public function showp(Request $request)
    {
         $data = DB::table('partidosvw')->select('*')
            ->where('partidosvw.id_equipo1',  '=', $request->id)
            ->orWhere('partidosvw.id_equipo2', '=', $request->id)
            ->get();
       // $data = DB::table('equipos')->select('*')->get();
       


       return response($data);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\GrupoPicture  $grupoPicture
     * @return \Illuminate\Http\Response
     */
  

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\GrupoPicture  $grupoPicture
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, GrupoPicture $grupoPicture)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\GrupoPicture  $grupoPicture
     * @return \Illuminate\Http\Response
     */
    public function destroy(GrupoPicture $grupoPicture)
    {
        //
    }
}
