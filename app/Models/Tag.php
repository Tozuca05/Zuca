<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Tag extends Model
{
    /**
     * TAG ATTRIBUTES
     * $this->attributes['id'] - int - contains the tag primary key (id)
     * $this->attributes['name'] - string - contains the tag name
     * $this->attributes['created_at'] - timestamp - contains the tag creation date
     * $this->attributes['updated_at'] - timestamp - contains the tag update date
     * $this->product - Products[] - contains the associated orders
     */
    public function products(): HasMany
    {
        return $this->hasMany(Product::class);  
    }

    public function playlist(): HasOne
    {
        return $this->hasOne(Playlist::class);
    }

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

    public function getUpdatedAt(): string
    {
        return $this->attributes['updated_at'];
    }
}
