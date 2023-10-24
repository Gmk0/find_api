<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ServiceResource;
use App\Models\Category;
use App\Models\Service;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Request as RequestFacade;

class CategoryController extends Controller
{
    //




    public function getAllCategories()
    {
        // Utiliser le modèle Category (assurez-vous qu'il existe) lié à la table des catégories.
        $categories = Category::with('subCategories')->get();

        return response()->json($categories);
    }

    public function getByCategoryId($categoryId)
    {

        $subcategories = SubCategory::where('category_id', $categoryId)->get();
        return response()->json(['subcategories' => $subcategories], 200);
    }

    public function subcategoriesByname($category)
    {

        $subcategories = SubCategory::whereHas('category', function($q) use($category){
            $q->where('name','like', "%". $category."%");
        })->get();
        return response()->json(['subcategories' => $subcategories], 200);

    }

    public function fetchAllServicesByCategory($category)
    {


        $service=Service::whereHas('category', function($q)use($category){
            $q->where('name', 'like', "%" . $category . "%");
        })->filter(RequestFacade::only('search', 'sub_category', 'orderBy', 'price', 'level', 'deliveryTime', 'tag'))
        ->paginate(5);

        $tags = $service->pluck('tag')
            ->map(function ($tag) {
                return is_string($tag) ? json_decode($tag, true) : $tag;
            })
            ->flatten() // Pour obtenir une collection à une seule dimension
            ->unique()
            ->all();

        if($service == null) {
            return  response()->json([], 422);
        }

        return ServiceResource::collection($service)->additional(['tags'=>$tags]);

    }

    public function getServicesBySub($subcategory)
    {

        $subcategoryElement = SubCategory::where('name', $subcategory)->first();

        if (!$subcategoryElement) {

            return  response()->json([], 422);
        }

        $service =Service::where('sub_category', 'like', '%' . $subcategoryElement->id . '%')
        ->filter(RequestFacade::only('search', 'sub_category', 'orderBy', 'price', 'level', 'deliveryTime', 'tag'))
        ->paginate(5);

        $tags =$service->pluck('tag')
                ->map(function ($tag) {
                    return is_string($tag) ? json_decode($tag, true) : $tag;
                })
                ->flatten() // Pour obtenir une collection à une seule dimension
                ->unique()
                ->all();

       // $service->filter(RequestFacade::only('search', 'sub_category', 'orderBy', 'price', 'level', 'deliveryTime', 'tag'));


        if($service ==null)
        {
            return  response()->json([], 422);
        }



        return ServiceResource::collection($service)->additional(['tags'=>$tags]);


    }

    public function fetchOneService($service)
    {
        try {
            // Recherchez le service spécifié par son numéro
            $service = Service::where('service_numero', $service)->first();

            if ($service == null) {
                return response()->json([], 422);
            }

            // Récupérez tous les services ayant la même catégorie, en excluant le service spécifié
            $servicesMemeCategorie = Service::where('category_id', $service->category_id)
                ->where('id', '!=', $service->id) // Excluez le service spécifié
                ->take(4)->get();

            // Vous pouvez maintenant renvoyer les services sous forme de ressource
            return (new ServiceResource($service))
            ->additional(['sameCategory'=>ServiceResource::collection($servicesMemeCategorie)]);
        } catch (\Exception $e) {
            // Gérez les erreurs ici
            return response()->json(['error'=>$e->getMessage()], 422);
        }





    }



}
