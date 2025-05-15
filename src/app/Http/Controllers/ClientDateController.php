<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Date;
use App\Models\User;
use DateTime;

class ClientDateController extends DateController
{
    private function verificar(int $id): bool {
        if(auth()->user()->id != $id) {
            return false;
        }
        return true;
    }
        /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $userId = auth()->id();
        
        $dates = Date::where('id_cliente', $userId)->get();
        
        return view('mydates.index', compact('dates'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::all();
        return view('mydates.create', compact('users'));
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

        return redirect()->route('mydates.index')->with('success', 'Cita creada correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $date = Date::findOrFail($id);
        if($this->verificar($date->cliente->id)) {
            return view('mydates.show', compact('date'));
        }
        else {
            abort('403', 'El usuario no tiene autorización de acceso a esta consulta');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $date = Date::findOrFail($id);
        if($this->verificar($date->cliente->id)) {
            $users = User::all();
            return view('mydates.edit', compact('date','users'));
        }
        else {
            abort('403', 'El usuario no tiene autorización de acceso a esta consulta');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        
        $date = Date::findOrFail($id);
        if($this->verificar($date->cliente->id)) {
            $fechayHora= new DateTime($request->fecha . ' ' . $request->hora);
            $request->fecha= $fechayHora->format('Y-m-d');
            $request->hora= $fechayHora->format('H:i');
            $rules = Date::rules($date->id);
            $request->validate($rules, [
                'id_cliente:exists' => 'El id del cliente no es valido',
                'id_cliente.integer' => 'El id del cliente debe ser un numero',
                'marca.required' => 'Debes incluír la marca del coche',
                'modelo.required' => 'Debes incluír el modelo del coche',
                'matricula.required' => 'Debes incluír la matricula del coche',
                'matricula.regex' => 'La matricula debe tener un formato de 4 numeros y 3 letras (en mayúsculas)',
            ]);
            
            $date->update($request->all());
    
            return redirect()->route('mydates.index')->with('success', 'Cita actualizada correctamente.');
        }
        else {
            abort('403', 'El usuario no tiene autorización de acceso a esta consulta');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $date = Date::findOrFail($id);
        if($this->verificar($date->cliente->id)) {
            $date->delete();
            return redirect()->route('mydates.index')->with('success', 'Cita borrada correctamente.');
        }
        else {
            abort('403', 'El usuario no tiene autorización de acceso a esta consulta');
        }
    }
}
