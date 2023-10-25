<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\FreelanceResource;
use App\Models\Freelance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FreelanceController extends Controller
{
    //

public function index(Request $request)
{



    $freelances = Freelance::query()
        ->with('category')
        ->with('user')
        ->orderBy('created_at', 'asc')
        ->filter($request->only('search', 'category', 'sub_category', 'price', 'level', 'disponible'))
        ->paginate(10)
        ->withQueryString()
        ->through(function ($freelance) {
            return [
                'id' => $freelance->id,
                'nom' => $freelance->nom,
                'prenom' => $freelance->prenom,
                'level' => $freelance->level,
                'identifiant' => $freelance->identifiant,
                'sub_categorie' => $freelance->subcategories(),
                'like' => $freelance->isFavorite(),
                'user' => $freelance->user
                    ? $freelance->user->only('name', 'profile_photo_url', 'profile_photo_path')
                    : null,
                'category' => $freelance->category
                    ? $freelance->category->only('name', 'id')
                    : null,
            ];
        });

    return response()->json([
        'filters' => $request->only('search', 'category', 'sub_category', 'price', 'level', 'disponible'),
        'freelances' => $freelances,
    ]);
}


public function getAllFreelance()
{
    $freelances= Freelance::paginate(10);

    return FreelanceResource::collection($freelances);


}

public function storeFreelance(Request $request)
{

    try{

            DB::beginTransaction();


                $data = [
                    'nom' => $request->nom,
                    'prenom' => $request->prenom,
                    'description' => $request->description,
                    'langue' => $request->langues,
                    'diplome' => $request->diplome,
                    'certificat' => $request->certificat,
                    'site' => $request->site,
                    'experience' => $request->experience,
                    'competences' => $request->competences,
                    'taux_journalier' => $request->taux_journalier,
                    'comptes' => $request->comptes,
                    'sub_categorie' => $request->sub_categorie,
                    'localisation' => $request->localisation,
                    'category_id' => $request->category_id,
                    'level' => 1,
                    'user_id' => $request->user()->id,
                ];

                Freelance::create($data);
                Db::commit();

            return  response()->json(['message' => 'comptes creer avec succes', 200]);

    }catch(\Exception $e){

            Db::rollBack();

            return  response()->json(['message' => $e->getMessage(),422]);

    }


}



}
