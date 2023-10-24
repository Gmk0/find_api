<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
       // return parent::toArray($request);
        return [
            'id'=>$this->id,
            'name' => $this->name,
            'phone' => $this->phone,
            'email' => $this->email,
            'email_verified_at'=>$this->email_verified_at,
            'is_online'=>$this->is_online,
            'last_activity'=>$this->last_activity,
            'profile_photo_path'=>$this->profile_photo_path,
            'profile_photo_url'=>$this->profile_photo_url,
            'isFreelance' => $this->freelance ? true:false,
            'created_at'=>$this->created_at,

            ];
    }
}
