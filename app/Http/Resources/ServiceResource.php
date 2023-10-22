<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ServiceResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'basic_price' => $this->basic_price,
            'service_numero' => $this->service_numero,
            'image' => $this->files,
            'sub_categorie' => $this->subcategories(),
            'like' => $this->isFavorite(),
            'orderCount' => $this->orderCount(),
            'average' => $this->averageFeedback(),
            'freelance' => $this->freelance ? $this->freelance->only('nom', 'prenom', 'identifiant', 'level') : null,
            'user' => $this->freelance->user ? $this->freelance->user->only('name', 'profile_photo_path', 'profile_photo_url') : null,
            'category' => $this->category ? $this->category->only('name', 'id') : null,
            ];
    }
}
