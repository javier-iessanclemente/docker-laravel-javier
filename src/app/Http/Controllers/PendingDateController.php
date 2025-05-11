<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Date;
use App\Models\User;
use DateTime;

class PendingDateController extends DateController
{
        /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dates = Date::where(function ($query) {
            $query->whereNull('fecha')
                  ->orWhereNull('hora')
                  ->orWhereNull('duracion');
        })->get();
        return view('pending_dates.index', compact('dates'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::all();
        return view('pending_dates.create', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(Date::rules(), [
            'id_cliente:exists' => 'El id del cliente no es valido',
            'id_cliente.integer' => 'El id del cliente debe ser un numero',
            'marca.required' => 'Debes incluír la marca del coche',
            'modelo.required' => 'Debes incluír el modelo del coche',
            'matricula.required' => 'Debes incluír la matricula del coche',
            'matricula.regex' => 'La matricula debe tener un formato de 4 numeros y 3 letras (en mayúsculas)',
            'fecha.date' => 'La fecha no tiene un formato adecuado',
            'fecha.after' => 'La fecha debe ser posterior a la fecha actual',
            'hora.date_format' => 'La hora no tiene un formato adecuado',
            'duracion.integer' => 'La duración debe ser un numero',
        ]);
        
        if($request->fecha == null && $request->hora == null && $request->duracion == null) {
            Date::create([
                'id_cliente' => $request->id_cliente,
                'marca'=> $request->marca,
                'matricula'=> $request->matricula,
                'modelo'=> $request->modelo,
            ]);
        }
        else {
            Date::create([
                'id_cliente' => $request->id_cliente,
                'fecha' => $request->fecha,
                'hora' => $request->hora,
                'duracion' => $request->duracion,
                'marca'=> $request->marca,
                'matricula'=> $request->matricula,
                'modelo'=> $request->modelo,
            ]);
        }

        return redirect()->route('pending_dates.index')->with('success', 'Cita creada correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $date = Date::findOrFail($id);
        return view('pending_dates.show', compact('date'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $date = Date::findOrFail($id);
        $users = User::all();
        return view('pending_dates.edit', compact('date','users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $fechayHora= new DateTime($request->fecha . ' ' . $request->hora);
        $request->fecha= $fechayHora->format('Y-m-d');
        $request->hora= $fechayHora->format('H:i');
        $date = Date::findOrFail($id);
        $rules = Date::rules($date->id);
        $request->validate($rules, [
            'id_cliente:exists' => 'El id del cliente no es valido',
            'id_cliente.integer' => 'El id del cliente debe ser un numero',
            'marca.required' => 'Debes incluír la marca del coche',
            'modelo.required' => 'Debes incluír el modelo del coche',
            'matricula.required' => 'Debes incluír la matricula del coche',
            'matricula.regex' => 'La matricula debe tener un formato de 4 numeros y 3 letras (en mayúsculas)',
            'fecha.date' => 'La fecha no tiene un formato adecuado',
            'fecha.after' => 'La fecha debe ser posterior a la fecha actual',
            'hora.date_format' => 'La hora no tiene un formato adecuado',
            'duracion.integer' => 'La duración debe ser un numero',
        ]);
    
        $date->update($request->all());
    
        return redirect()->route('pending_dates.index')->with('success', 'Cita actualizada correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $date = Date::findOrFail($id);
        $date->delete();
        return redirect()->route('pending_dates.index')->with('success', 'Cita borrada correctamente.');
    }
}
