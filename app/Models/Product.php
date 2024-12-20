<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    /**
     * PRODUCT ATTRIBUTES
     * $this->attributes['id'] - int - contains the product primary key (id)
     * $this->attributes['name'] - string - contains the product name
     * $this->attributes['description'] - string - contains the product description
     * $this->attributes['image'] - string - contains the product image
     * $this->attributes['price'] - int - contains the product price
     * $this->attributes['created_at'] - string - timestamp - contains the product creation date
     * $this->attributes['updated_at'] - string - timestamp - contains the product update date
     * $this->attributes['stock'] - int - contains the product stock
     * $this->attributes['tag_id'] - int - contains the id of the associated tag
     * $this->items - Item[] - contains the associated items
     * $this->tag - Tag - contains the associated tag
     */
    use HasFactory;
    
     public function items(): HasMany
    {
        return $this->hasMany(Item::class);
    }

    public function tag(): BelongsTo
    {
        return $this->belongsTo(Tag::class);
    }

    public function getItems(): HasMany
    {
        return $this->items();
    }

    public function setItems(HasMany $items): void
    {
        $this->items = $items;
    }

    public function getId(): int
    {
        return $this->attributes['id'];
    }

    public function setId(int $id): void
    {
        $this->attributes['id'] = $id;
    }

    public function getName(): string
    {
        return $this->attributes['name'];
    }

    public function setName(string $name): void
    {
        $this->attributes['name'] = $name;
    }

    public function getDescription(): string
    {
        return $this->attributes['description'];
    }

    public function setDescription(string $description): void
    {
        $this->attributes['description'] = $description;
    }

    public function getImage(): string
    {
        return $this->attributes['image'];
    }

    public function setImage(string $image): void
    {
        $this->attributes['image'] = $image;
    }

    public function getPrice(): int
    {
        return $this->attributes['price'];
    }

    public function setPrice(int $price): void
    {
        $this->attributes['price'] = $price;
    }

    public function getStock(): int
    {
        return $this->attributes['stock'];
    }

    public function setStock(int $stock): void
    {
        $this->attributes['stock'] = $stock;
    }

    public function getTagId(): int
    {
        return $this->attributes['tag_id'];
    }

    public function setTagId(int $tagId): void
    {
        $this->attributes['tag_id'] = $tagId;
    }

    public static function validate($request): void
    {
        $request->validate([
            'name' => 'required|max:255',
            'description' => 'required',
            'price' => 'required|numeric|gt:0',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'stock' => 'required|numeric|gt:-1',
            'tag_id' => 'required|exists:tags,id',
        ]);
    }

    public static function sumPricesByQuantities($products, $productsInSession): int
    {
        $total = 0;
        foreach ($products as $product) {
            $total = $total + ($product->getPrice() * $productsInSession[$product->getId()]);
        }

        return $total;
    }
}
