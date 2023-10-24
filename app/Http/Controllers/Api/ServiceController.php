<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ServiceResource;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Request as RequestFacade;

class ServiceController extends Controller
{
    //

    public function popularServices()
    {

        $service = Service::latest()->take(10)->get();

        $tags = $service->pluck('tag')
        ->map(function ($tag) {
            return is_string($tag) ? json_decode($tag, true) : $tag;
        })
            ->flatten() // Pour obtenir une collection à une seule dimension
            ->unique()
            ->all();

        if ($service == null) {
            return  response()->json([], 422);
        }

        return ServiceResource::collection($service)->additional(['tags' => $tags]);

    }
    public function bestServices()
    {
        $service = Service::latest()->take(10)->get();

        $tags = $service->pluck('tag')
        ->map(function ($tag) {
            return is_string($tag) ? json_decode($tag, true) : $tag;
        })
            ->flatten() // Pour obtenir une collection à une seule dimension
            ->unique()
            ->all();

        if ($service == null) {
            return  response()->json([], 422);
        }
        return ServiceResource::collection($service)->additional(['tags' => $tags]);
    }
}
