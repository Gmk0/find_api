<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\FreelanceResource;
use App\Models\Freelance;
use Illuminate\Http\Request;

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


    return  response()->json(['freelance' =>$request->all()]);

}



}
