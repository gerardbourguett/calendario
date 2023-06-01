<?php

namespace App\Http\Controllers;

use App\Models\Audiencia;
use Illuminate\Http\Request;

class AudienciaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        //
        $id = rand(1, 9999999); // Crea un valor que solo sirve para index.blade.php, La base de datos asigna un  numero incremental distinto
        return view('audiencias.index', compact('id'));
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
        request()->validate(Audiencia::$rules);
        $audiencia = Audiencia::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Audiencia  $audiencia
     * @return \Illuminate\Http\Response
     */
    public function show(Audiencia $audiencia)
    {
        $audiencias = Audiencia::all();

        // Transformar los nombres de los atributos a minúsculas
        $audiencias = $audiencias->map(function ($item) {
            $item->textColor = $item->textcolor;
            $item->backgroundColor = $item->backgroundcolor;
            unset($item->backgroundcolor);
            unset($item->textcolor);
            return $item;
        });

        return response()->json($audiencias);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Audiencia  $audiencia
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $audiencia = Audiencia::find($id);

        // Transformar los nombres de los atributos a minúsculas
        $audiencia->textColor = $audiencia->textcolor;
        $audiencia->backgroundColor = $audiencia->backgroundcolor;
        unset($audiencia->textcolor);
        unset($audiencia->backgroundcolor);

        return response()->json($audiencia);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Audiencia  $audiencia
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Audiencia $audiencia)
    {
        //
        request()->validate(Audiencia::$rules);
        $audiencia->update($request->all());

        return response()->json(['success' => 'Audiencia actualizada correctamente']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Audiencia  $audiencia
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $audiencia = Audiencia::find($id);
        $audiencia->delete();

        return response()->json(['success' => 'Audiencia eliminada correctamente']);
    }
}
