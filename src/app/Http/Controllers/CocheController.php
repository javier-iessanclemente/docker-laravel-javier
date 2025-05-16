<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Coche;
use Illuminate\Validation\ValidationException;

class CocheController extends Controller
{
    public function verificar($coche) {
        if($coche != null && $coche->id_cliente == auth()->user()->id) {
            return true;
        }
        else {
            return false;
        }
    }
    public function index()
    {
        $coches= Coche::where('id_cliente', auth()->user()->id)->get();
        return view('cars.index', [
            'coches' => response()->json($coches),
        ]);
    }

    public function create()
    {
        return view('cars.create');
    }

    public function store(Request $request)
    {
        try {
            $rules= Coche::rules();
            unset($rules['id_cliente']);
            $request->validate($rules, [
                'id_cliente:exists' => 'El id del cliente no es valido',
                'id_cliente.integer' => 'El id del cliente debe ser un numero',
                'marca.required' => 'Debes incluír la marca del coche',
                'modelo.required' => 'Debes incluír el modelo del coche',
                'matricula.required' => 'Debes incluír la matricula del coche',
                'matricula.regex' => 'La matricula debe tener un formato de 4 numeros y 3 letras (en mayúsculas)',
            ]);
    
            $coche = Coche::create([
                'id_cliente' => auth()->user()->id,
                'marca' => $request->marca,
                'modelo' => $request->modelo,
                'matricula' => $request->matricula,
            ]);
    
            if($coche != null) {
                $respuesta= response()->json($coche, 201);
                if($respuesta->getStatusCode() == 201) {
                    return redirect()->route('cars.index')->with('success', 'Coche creado correctamente.');
                }
            }
            else {
                return redirect()->route('cars.create')->with('error', 'El coche no pudo ser creado');
            }
        }
        catch (ValidationException $e) {
            throw $e;
        }
        catch(\Exception $e) {
            return redirect()->route('cars.create')->with('error', 'El coche no pudo ser creado: ' . $e->getMessage());
        }

    }

    public function show($id)
    {
        $coche = Coche::findOrFail($id);
        if($this->verificar($coche)) {
            return view('cars.show', [
                'coche' => response()->json($coche),
            ]);
        }
        else {
            abort(403, 'No autorizado a visualizar este coche');
        }
    }

    public function edit($id) 
    {
        $coche = Coche::findOrFail($id);
        if($this->verificar($coche)) {
            return view('cars.edit', [
                'coche' => response()->json($coche),
            ]);
        }
        else {
            abort(403, 'No autorizado a editar este coche');
        }
    }
    public function update(Request $request, $id)
    {
        try {
            $rules= Coche::rules();
            unset($rules['id_cliente']);
            $request->validate($rules, [
                'id_cliente:exists' => 'El id del cliente no es valido',
                'id_cliente.integer' => 'El id del cliente debe ser un numero',
                'marca.required' => 'Debes incluír la marca del coche',
                'modelo.required' => 'Debes incluír el modelo del coche',
                'matricula.required' => 'Debes incluír la matricula del coche',
                'matricula.regex' => 'La matricula debe tener un formato de 4 numeros y 3 letras (en mayúsculas)',
            ]);
            $coche = Coche::findOrFail($id);
            $coche->update($request->all());
            $resultado= response()->json($coche);
            if($resultado->getStatusCode() == 200) {
                return redirect()->route('cars.index')->with('success', 'Coche actualizado correctamente.');
            }
        }
        catch (ValidationException $e) {
            throw $e;
        }
        catch(\Exception $e) {
            return redirect()->route('cars.edit', ['car' => $id])->with('error', 'El coche no pudo ser editado: ' . $e->getMessage());
        }

    }

    public function destroy($id)
    {
        try {
            $coche= Coche::find($id);
            if($this->verificar($coche)) {
                Coche::destroy($id);
                $coche= Coche::find($id);
                $resultado= response()->json(null, 204);
                if($coche != null) {
                    return redirect()->route('cars.index')->with('error', 'El coche no fue borrado correctamente.');
                }
                else {
                    if($resultado->getStatusCode() == 204) {
                        return redirect()->route('cars.index')->with('success', 'Coche borrado correctamente.');
                    }
                }
            }
            else {
                abort(403, "No autorizado a borrar este coche");
            }
        }
        catch(\Exception $e) {
            return redirect()->route('cars.index')->with('error', 'El coche no pudo ser borrado: ' . $e->getMessage());
        }
        
    }
}
