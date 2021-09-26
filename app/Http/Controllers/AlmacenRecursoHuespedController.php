<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Almacen_Recurso_Huesped;

class AlmacenRecursoHuespedController extends Controller
{
     //
        /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function vista_RH()
    {
        //
        return view('sistema.rol.admin.almacenes.almacenes_RH');
        
    }
    //
        /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return $AlmacenRH = Almacen_Recurso_Huesped::all();
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
        $almacenRH = new Almacen_Recurso_Huesped();
        $almacenRH->nombre=$request->get('nombre');
        $almacenRH->ubicacion=$request->get('ubicacion');
        $almacenRH->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        return $almacenRH = Almacen_Recurso_Huesped::find($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $almacenRH = Almacen_Recurso_Huesped::find($id);
          $almacenRH->nombre=$request->get('nombre');
        $almacenRH->ubicacion=$request->get('ubicacion');
        $almacenRH->update();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         $almacenRH = Almacen_Recurso_Huesped::find($id);
         $almacenRH->delete();
    }
}
