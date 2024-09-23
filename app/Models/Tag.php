<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    /**
     * TAG ATTRIBUTES
     * $this->attributes['id'] - int - contiene la clave primaria (id) de la etiqueta
     * $this->attributes['name'] - string - contiene el nombre de la etiqueta
     * $this->attributes['created_at'] - timestamp - contiene la fecha de creación de la etiqueta
     * $this->attributes['updated_at'] - timestamp - contiene la fecha de actualización de la etiqueta
     */

    public function getId(): int
    {
        return $this->attributes['id'];
    }

    public function getName(): string
    {
        return $this->attributes['name'];
    }

    public function setName(string $name): void
    {
        $this->attributes['name'] = $name;
    }

    public function getCreatedAt(): string
    {
        return $this->attributes['created_at'];
    }

    public function setCreatedAt($createdAt): void
    {
        $this->attributes['created_at'] = $createdAt;
    }

    public function getUpdatedAt(): string
    {
        return $this->attributes['updated_at'];
    }

    public function setUpdatedAt($updatedAt): void
    {
        $this->attributes['updated_at'] = $updatedAt;
    }

    // ... código existente ...
}
