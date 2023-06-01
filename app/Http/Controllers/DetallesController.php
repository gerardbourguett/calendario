<?php

namespace App\Http\Controllers;

use App\Models\Audiencia;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DetallesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Obtener los eventos del día actual
        $events = Audiencia::whereDate('start', Carbon::today())
            ->get(['id', 'title', 'start', 'end', 'tipo_audiencia', 'sala', 'magis', 'abo_patrocinante', 'observaciones']);

        // Obtener todos los eventos
        $total_events = Audiencia::get(['id', 'title', 'start', 'end', 'tipo_audiencia', 'sala', 'magis', 'abo_patrocinante', 'observaciones']);

        // Obtener los eventos de la semana en curso
        $week_events = Audiencia::whereBetween('start', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
            ->get(['id', 'title', 'start', 'end', 'tipo_audiencia', 'sala', 'magis', 'abo_patrocinante', 'observaciones']);

        return view('detalles.index', compact('events', 'total_events', 'week_events'));
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
    }
}
