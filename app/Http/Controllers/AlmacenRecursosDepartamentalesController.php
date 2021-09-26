<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\AlmacenRecursosDepartamentales;

class AlmacenRecursosDepartamentalesController extends Controller
{
    //
        /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function vista_RD()
    {
        //
        return view('sistema.rol.admin.almacenes.almacenes_RD');
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
        return $AlmacenD = AlmacenRecursosDepartamentales::all();
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
         $AlmacenD = new AlmacenRecursosDepartamentales();
        $AlmacenD->nombre = $request->get('nombre');
        $AlmacenD->ubicacion = $request->get('ubicacion');
        $AlmacenD->save();
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
        return $AlmacenD = AlmacenRecursosDepartamentales::find($id);
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
        $AlmacenD = AlmacenRecursosDepartamentales::find($id);
           $AlmacenD->nombre = $request->get('nombre');
        $AlmacenD->ubicacion = $request->get('ubicacion');
        $AlmacenD->update();
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
          $AlmacenD = AlmacenRecursosDepartamentales::find($id);
          $AlmacenD->delete();
    }
}
