<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;


class Order extends Model
{
    /**
     * ORDER ATTRIBUTES
     * $this->attributes['id'] - int - contains the order primary key (id)
     * $this->attributes['total'] - float - contains the order total
     * $this->attributes['status'] - string - contains the order status (e.g., 'pending', 'processing', 'shipped', 'completed')
     * $this->attributes['created_at'] - timestamp - contains the order creation date
     * $this->attributes['updated_at'] - timestamp - contains the order update date
     * $this->attributes['user_id'] - int - contains the user ID (foreign key)
     * $this->user - User - contains the associated User
     * $this->items - Item[] - contains the associated items
     */

    protected $fillable = [
        'total',
        'status',
        'user_id',
    ];

    public function getId(): int
    {
        return $this->attributes['id'];
    }

    public function setId(int $id): void
    {
        $this->attributes['id'] = $id;
    }

    public function getTotal(): float
    {
        return $this->attributes['total'];
    }

    public function setTotal(float $total): void
    {
        $this->attributes['total'] = $total;
    }

    public function getStatus(): string
    {
        return $this->attributes['status'];
    }

    public function setStatus(string $status): void
    {
        $this->attributes['status'] = $status;
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

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function getUser(): User
    {
        return $this->user;
    }

    public function setUser(User $user): void
    {
        $this->user = $user;
    }
    public function getUserId(): int
    {
        return $this->attributes['user_id'];
    }
    public function setUserId(int $userId): void
    {
        $this->attributes['user_id'] = $userId;
    }

    public function items(): HasMany
    {
        return $this->hasMany(Item::class);
    }

    public function getItems()
    {
        return $this->items;
    }

    public function setItems($items)
    {
        $this->items = $items;
    }
}