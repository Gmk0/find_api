<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FreelanceResource extends JsonResource
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
            'nom' => $this->nom,
            'prenom' => $this->prenom,
            'level' => $this->level,
            'identifiant' => $this->identifiant,
            'sub_categorie' => $this->subcategories(),
            'like' => 45,
            'user' => $this->user
                ? $this->user->only('name', 'profile_photo_url', 'profile_photo_path')
                : null,
            'category' => $this->category
                ? $this->category->only('name', 'id')
                : null,
        ];
    }
}
