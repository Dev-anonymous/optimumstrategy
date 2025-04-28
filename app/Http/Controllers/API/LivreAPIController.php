<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Livre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class LivreAPIController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Livre::orderBy('titre')->get();
        $t = [];
        foreach ($data as $e) {
            $o = (object) $e->toArray();
            $o->prixv = v($e->prix, $e->devise);
            $t[] = $o;
        }
        $data = $t;
        return $data;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make(request()->all(), [
            'reduction' => 'required|numeric|min:0|max:90',
            'prix' => 'required|numeric|min:1',
            'devise' => 'required|in:CDF,USD',
            'titre' => 'required|string|max:100',
            'auteur' => 'required|string|max:100',
            'aproposauteur' => 'required|string',
            'annee' => ['required', 'regex:/^\d{4}$/'],
            'description' => 'required|max:255',
            'longuedescription' => 'required|string',
            'fichier' => 'required|mimes:pdf',
            'affiche' => 'required|mimes:png',
        ], ['annee.regex' => "Annee non valide"]);

        if ($validator->fails()) {
            $m = implode(" ", $validator->errors()->all());
            return response([
                'message' => $m
            ]);
        }

        $data = $validator->validated();
        $data['fichier'] = request('fichier')->store('book', 'public');
        $data['affiche'] = request('affiche')->store('img', 'public');

        $data['date'] = nnow();

        Livre::create($data);
        return response([
            'success' => true,
            'message' => "Livre créé avec succès."
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Livre  $livre
     * @return \Illuminate\Http\Response
     */
    public function show(Livre $livre)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Livre  $livre
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Livre $livre)
    {
        $validator = Validator::make(request()->all(), [
            'reduction' => 'required|numeric|min:0|max:90',
            'prix' => 'required|numeric|min:1',
            'devise' => 'required|in:CDF,USD',
            'titre' => 'required|string|max:100',
            'auteur' => 'required|string|max:100',
            'aproposauteur' => 'required|string',
            'annee' => ['required', 'regex:/^\d{4}$/'],
            'description' => 'required|max:255',
            'longuedescription' => 'required|string',
            'fichier' => 'sometimes|mimes:pdf',
            'affiche' => 'sometimes|mimes:png',
        ], ['annee.regex' => "Annee non valide"]);

        if ($validator->fails()) {
            $m = implode(" ", $validator->errors()->all());
            return response([
                'message' => $m
            ]);
        }
        $data = $validator->validated();
        if (request('fichier')) {
            $data['fichier'] = request('fichier')->store('book', 'public');
            File::delete('storage/' . $livre->fichier);
        }
        if (request('affiche')) {
            $data['affiche'] = request('affiche')->store('img', 'public');
            File::delete('storage/' . $livre->affiche);
        }
        $livre->update($data);

        return response([
            'success' => true,
            'message' => "Livre mis à jour avec succès."
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Livre  $livre
     * @return \Illuminate\Http\Response
     */
    public function destroy(Livre $livre)
    {
        $livre->delete();
        File::delete('storage/' . $livre->fichier);
        File::delete('storage/' . $livre->affiche);
        return response()->json([
            'success' => true,
            'message' => 'Livre supprimé.'
        ], 200);
    }
}
