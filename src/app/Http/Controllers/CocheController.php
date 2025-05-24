<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Coche;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Validator;

class CocheController extends Controller
{
    public function index(Request $request)
    {
        
        $datos= $request->json()->all();
        return response()->json(Coche::where('id_cliente', $datos['id_cliente'])->get());
    }

    public function store(Request $request)
    {
        $datos= $request->json()->all();
            $valido= Validator::make($datos, [
                'id_cliente' => 'required|exists:users,id',
                'marca' => 'required|string',
                'modelo' => 'required|string',
                'matricula' => 'required|string|regex:/^[0-9]{4}[A-Z]{3}$/'
            ], [
                'id_cliente.exists' => 'El id del cliente no es valido',
                'id_cliente.integer' => 'El id del cliente debe ser un numero',
                'marca.required' => 'Debes incluír la marca del coche',
                'modelo.required' => 'Debes incluír el modelo del coche',
                'matricula.required' => 'Debes incluír la matricula del coche',
                'matricula.regex' => 'La matricula debe tener un formato de 4 numeros y 3 letras (en mayúsculas)'
            ]);
            if ($valido->fails()) {
                return response()->json(['errors' => $valido->errors()->all()], 400);
            }
            $coche = Coche::create($datos);
            return response()->json($coche, 201);
            return response()->json(['errors' => $e->errors()], 400);
    }

    public function show($id)
    {
        $coche = Coche::findOrFail($id);
        return response()->json($coche);
    }

    public function update(Request $request, $id)
    {
        $coche = Coche::findOrFail($id);
        $datos= $request->json()->all();
        $valido= Validator::make($datos, [
            'id_cliente' => 'required|exists:users,id',
            'marca' => 'required|string',
            'modelo' => 'required|string',
            'matricula' => 'required|string|regex:/^[0-9]{4}[A-Z]{3}$/'
        ], [
            'id_cliente.exists' => 'El id del cliente no es valido',
            'id_cliente.integer' => 'El id del cliente debe ser un numero',
            'marca.required' => 'Debes incluír la marca del coche',
            'modelo.required' => 'Debes incluír el modelo del coche',
            'matricula.required' => 'Debes incluír la matricula del coche',
            'matricula.regex' => 'La matricula debe tener un formato de 4 numeros y 3 letras (en mayúsculas)'
        ]);
        if ($valido->fails()) {
            return response()->json(['errors' => $valido->errors()->all()], 400);
        }
        $coche->update($request->all());
        return response()->json($coche);
    }

    public function destroy($id)
    {
        Coche::destroy($id);
        return response()->json(null, 204);
    }
}
