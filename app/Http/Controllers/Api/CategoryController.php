<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ServiceResource;
use App\Models\Category;
use App\Models\Service;
use App\Models\SubCategory;
use Illuminate\Http\Request;

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
        })->get();

        return ServiceResource::collection($service);

    }

    public function fetchOneService($service)
    {


        $service=Service::where('service_numero', $service)->first();

       // return $service;
        return(new ServiceResource($service));



    }



}
