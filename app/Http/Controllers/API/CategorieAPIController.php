<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Categorieblog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategorieAPIController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Categorieblog::orderBy('categorie')->get();
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
            'categorie' => 'required|unique:categorieblog',
        ]);

        if ($validator->fails()) {
            $m = implode(" ", $validator->errors()->all());
            return response([
                'message' => $m
            ]);
        }

        $data = $validator->validated();
        $data['categorie'] = ucfirst($data['categorie']);

        Categorieblog::create($data);

        return response([
            'success' => true,
            'message' => "Catégorie créée avec succès."
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Categorieblog  $Categorieblog
     * @return \Illuminate\Http\Response
     */
    public function show(Categorieblog $categorie)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Categorieblog  $Categorieblog
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Categorieblog $categorie)
    {
        $validator = Validator::make(request()->all(), [
            'categorie' => 'required|unique:categorieblog,id,' . $categorie->id,
        ]);

        if ($validator->fails()) {
            $m = implode(" ", $validator->errors()->all());
            return response([
                'message' => $m
            ]);
        }

        $data = $validator->validated();
        $data['categorie'] = ucfirst($data['categorie']);
        $categorie->update($data);

        return response([
            'success' => true,
            'message' => "Catégorie mis à jour avec succès."
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Categorieblog  $Categorieblog
     * @return \Illuminate\Http\Response
     */
    public function destroy(Categorieblog $categorie)
    {
        if ($categorie->blogs()->count()) {
            return response([
                'message' => "Veuillez déplacer tous les blog de cette catégorie avant de la supprimer."
            ]);
        }

        $categorie->delete();
        return response([
            'success' => true,
            'message' => "Catégorie supprimée avec succès."
        ]);
    }
}
