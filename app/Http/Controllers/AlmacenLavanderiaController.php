<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\AlmacenLavanderia;

class AlmacenLavanderiaController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function Vista_RL()
    {
        return view('sistema.rol.admin.almacenes.almacenes_lavanderia');
    }

     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $AlmacenesLavado = AlmacenLavanderia::all();
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
        $AlmacenL = new AlmacenLavanderia();
        $AlmacenL->nombre = $request->get('nombre');
        $AlmacenL->ubicacion = $request->get('ubicacion');
        $AlmacenL->save();
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
        return $AlmacenL = AlmacenLavanderia::find($id);
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
        $AlmacenL = AlmacenLavanderia::find($id);
         $AlmacenL->nombre = $request->get('nombre');
        $AlmacenL->ubicacion = $request->get('ubicacion');
        $AlmacenL->update();

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $AlmacenL = AlmacenLavanderia::find($id);
        $AlmacenL->delete();
    }
}
