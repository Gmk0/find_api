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
            'basic_delivery_time'=>$this->basic_delivery_time,
            'service_numero' => $this->service_numero,
            'description' => $this->description,
            'basic_support' => $this->basic_support,
            'basic_revision' => $this->basic_revision,
            'basic_delivery_time' => $this->basic_delivery_time,
            'premium_price' => $this->premium_price,
            'premium_support' => $this->premium_support,
            'premium_revision' => $this->premium_revision,
            'premium_delivery_time' => $this->premium_delivery_time,
            'extra_price' => $this->extra_price,
            'extra_support' => $this->extra_support,
            'extra_revision' => $this->extra_revision,
            'extra_delivery_time' => $this->extra_delivery_time,
            'example' => $this->example,
            'need_service' => $this->need_service,
            'delivery_time_unit' => $this->delivery_time_unit,
            'video_url' => $this->video_url,
            'view_count' => $this->view_count,
            'like' => $this->like,
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
