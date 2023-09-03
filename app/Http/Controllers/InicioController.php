<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pokemon;
use Illuminate\Support\Facades\Storage;

class InicioController extends Controller
{
	public function index()
	{
		$poks = Pokemon::get();

        // dd($poks);
        return view('dashboard', ['poks' => $poks]);

	}

    public function create(Request $request)
    {
        // $result = [
        //     "error" => true,
        //     "messages" => "",
        //     "data" => []
        // ];

        // try {
        //     return Inertia::render('Client/Create', compact('states', 'cities'));

        // } catch (\Exception $e) {
        //     $result["error"]  = true;
        //     $result["messages"] = "Algo salió mal " . $e->getMessage() . ' ' . $e->getLine();
        //     return response()->json($result, 500);
        // }
    }

	public function store(Request $request)
	{
        $request->validate([
            "name" => "required|max:20",
            'attack' => "required",
            'defense' => "required",
            'speed' => "required",
            'image' => "max:255",
            'image' => 'image|max:4096', // Validar que sea una imagen y no supere 4 MB
        ]);

        // Valido si la imagen se cargó
        // if($request->hasFile("image")){
        //     $image = $request->file("image")->store('/clients/');
        //     $url = Storage::url($image);

        //     // Asigno la url al arreglo
        //     $client['clie_rutafoto'] = $url;
        // }

        if ($request->hasFile('image')) {
            $imagen = $request->file('image');
            $nombreImagen = time() . '.' . $imagen->getClientOriginalExtension();
            $imagen->storeAs('public', $nombreImagen);
            // Storage::disk('local')->put($nombreImagen, 'Contents');

        } else {

            $nombreImagen = '';
        }

        // dd($imagen);

        try {
            $pok = new Pokemon();
            $pok->name = $request->name;
            $pok->attack = $request->attack;
            $pok->defense = $request->defense;
            $pok->speed = $request->speed;
            $pok->image = $nombreImagen;

            $pok->save();

            // return response()->json(["message" => "Pókemon registrado", "pok" => $pok], 201);
            return redirect()->route('index')->with('success', 'Registro grabado con éxito');

        } catch (\Exception $e) {
            $result["error"]  = true;
            $result["messages"] = "Algo salió mal " . $e->getMessage() . ' ' . $e->getLine();
            return response()->json($result, 500);
        }

	}

	public function show(string $id)
	{
		//
	}

    public function edit(Pokemon $pokemon, Request $request)
    {
        //
    }

	public function update(Request $request, string $id)
	{
		$request->validate([
            "name" => "required|max:20",
            'attack' => "required",
            'defense' => "required",
            'speed' => "required",
            'image' => "image|max:4096",
            // 'image' => 'image|max:4096', // Validar que sea una imagen y no supere 4 MB
        ]);

        try {

            if ($request->hasFile('image')) {
                $imagen = $request->file('image');
                $nombreImagen = time() . '.' . $imagen->getClientOriginalExtension();
                $imagen->storeAs('public', $nombreImagen);
                // Storage::disk('local')->put($nombreImagen, 'Contents');

            } else {

                $nombreImagen = '';
            }

            $pokUpd = [];
            $pokUpd['name'] = $request->name;
            $pokUpd['attack'] = $request->attack;
            $pokUpd['defense'] = $request->defense;
            $pokUpd['speed'] = $request->speed;
            $pokUpd['image'] = $nombreImagen;

            $pok = Pokemon::find($request->id);
            $pok->update($pokUpd);

            // return response()->json(["message" => "Pókemon registrado", "pok" => $pok], 201);
            return redirect()->route('index')->with('success', 'Registro actualizado con éxito');

        } catch (\Exception $e) {
            $result["error"]  = true;
            $result["messages"] = "Algo salió mal " . $e->getMessage() . ' ' . $e->getLine();
            return response()->json($result, 500);
        }

	}

	public function destroy(string $id)
	{
        try {
            $pokemon = Pokemon::find($id);
            $pokemon->delete();

            // return response()->json(["message" => "Pókemon eliminado"], 200);

            return redirect()->route('index')->with('success', 'Registro eliminado con éxito');

        } catch (\Exception $e) {
            $result["error"]  = true;
            $result["messages"] = "Algo salió mal " . $e->getMessage() . ' ' . $e->getLine();
            return response()->json($result, 500);
        }

	}
}
