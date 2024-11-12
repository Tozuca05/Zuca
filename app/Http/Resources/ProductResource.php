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
            // Usa rtrim para eliminar cualquier barra al final de la URL base
            'link' => rtrim(config('app.url'), '/') . "/products/{$this->id}",
        ];
    }
}
