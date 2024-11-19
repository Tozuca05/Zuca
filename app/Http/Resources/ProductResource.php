<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'price' => $this->price,
            'stock' => $this->stock,
            'link' => rtrim(config('app.url'), '/') . "/products/{$this->id}",
            // Incluir el tag del producto
            'tag' => $this->tag ? $this->tag->name : null, // Muestra el nombre del tag, si existe
        ];
    }
}
