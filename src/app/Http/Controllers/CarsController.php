<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Coche;

class CarsController extends Controller
{
    public function index()
    {
        return view('cars.index');
    }

    public function store(Request $request)
    {
        $coche = Coche::create($request->all());
        return response()->json($coche, 201);
    }

    public function show($id)
    {
        $coche = Coche::findOrFail($id);
        return response()->json($coche);
    }

    public function update(Request $request, $id)
    {
        $coche = Coche::findOrFail($id);
        $coche->update($request->all());
        return response()->json($coche);
    }

    public function destroy($id)
    {
        Coche::destroy($id);
        return response()->json(null, 204);
    }
}
