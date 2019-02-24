<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class RecipeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
        'id' => $this->id,
        'user' => $this->user,
        'yummly_recipe_id' => $this->yummly_recipe_id,
        'recipe_name' => $this->recipe_name,
        'image_url' => $this->image_url,
        'created_at' => (string) $this->created_at,
        'updated_at' => (string) $this->updated_at
        ];
    }
}
