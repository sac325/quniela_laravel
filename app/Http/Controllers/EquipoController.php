<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Equipo;
use Illuminate\Http\Request;

class EquipoController extends Controller
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
      $data = DB::table('equipos')->select('*')->get();
      
      
      return view('equipo')->with('data', $data);
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
      
      $request->validate([
        'equipo_ins' => 'required|max:255',
        'image' => 'required',
        
    ]);
      $equipo = new Equipo;
			//$imgdt = $request->$image;
			//$id = DB::table('equipos')->insertGetId(['image_data' => $imgdt]);
      
      $equipo->description = $request->image->getClientOriginalName();			
      $equipo->image_size = $request->image->getClientSize();	
      $equipo->image_data = $request->image;
      $request->image->storeAs('public/upload',$equipo->description);
      $equipo->equipo = $request->equipo_ins;
      $equipo->save();
      
      
      $data = DB::table('equipos')->select('*')->get();
      
      
      return view('equipo')->with('data', $data);	

       // return $this->index();
      
  }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Equipo  $equipo
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        if($request->ajax()){

            $data = DB::table('equipos')->select('*')->where('id_equipo',$request->id)->get();

            return response($data);

        }
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Equipo  $equipo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {

       DB::table('equipos')
       ->where('id_equipo', $request->id_equipo)
       ->update(['equipo' => $request->equipo]);
       DB::table('equipos')
       ->where('id_equipo', $request->id_equipo)
       ->update(['description' => $request->image->getClientOriginalName()]);;
       $data = DB::table('equipos')->select('*')->get();
       
       
       return view('equipo')->with('data', $data);
       

       
   }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Equipo  $equipo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        if($request->ajax()){

            // Equipo::destroy($request->id);

            return response(['message'=>'Equipo eliminado satisfactoriamente']);

        }    }
    }
