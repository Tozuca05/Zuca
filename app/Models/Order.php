<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Order extends Model
{
    /**
     * ORDER ATTRIBUTES
     * $this->attributes['id'] - int - contains the order primary key (id)
     * $this->attributes['user_id'] - int - contains the referenced user id
     * $this->attributes['created_at'] - timestamp - contains the order creation date
     * $this->attributes['updated_at'] - timestamp - contains the order update date
     * $this->attributes['status'] - string - contains the order status
     * $this->user - User - contains the associated User
     * $this->items - Item[] - contains the associated items
     * $this->playlist - Playlist - contains the associated playlist
     */
    protected $fillable = [
        'total',
        'user_id',
        'status',
        'paypal_order_id',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function items(): HasMany
    {
        return $this->hasMany(Item::class);
    }

    public function playlists(): BelongsToMany
    {
        return $this->belongsToMany(Playlist::class);
    }

    public function getId(): int
    {
        return $this->attributes['id'];
    }

    public function setId(int $id): void
    {
        $this->attributes['id'] = $id;
    }

    public function getTotal(): int
    {
        return $this->attributes['total'];
    }

    public function setTotal(float $total): void
    {
        $this->attributes['total'] = $total;
    }

    public function getUserId(): int
    {
        return $this->attributes['user_id'];
    }

    public function setUserId(int $userId): void
    {
        $this->attributes['user_id'] = $userId;
    }

    public function getStatus(): string
    {
        return $this->attributes['status'];
    }

    public function setStatus(string $status): void
    {
        $this->attributes['status'] = $status;
    }

    public function getPaypalOrderId(): ?string
    {
        return $this->attributes['paypal_order_id'];
    }

    public function setPaypalOrderId(string $paypalOrderId): void
    {
        $this->attributes['paypal_order_id'] = $paypalOrderId;
    }

    public function getCreatedAt(): ?string
    {
        return $this->attributes['created_at'];
    }

    public function getUpdatedAt(): ?string
    {
        return $this->attributes['updated_at'];
    }

    public function getUser(): User
    {
        return $this->user;
    }

    public function setUser(User $user): void
    {
        $this->user = $user;
    }

    public function getItems(): HasMany
    {
        return $this->items();
    }

    public function setItems(HasMany $items): void
    {
        $this->items = $items;
    }

    public static function validate($request): void
    {
        $request->validate([
            'total' => 'required|numeric|gt:0',
            'user_id' => 'required|exists:users,id',
            'status' => 'required|in:Pending,Paid,Shipped,Delivered',
        ]);
    }

    public function isPaid(): bool
    {
        return $this->getStatus() === 'Paid';
    }

    public function getAssociatedPlaylist(): ?Playlist
    {
        $maxQuantity = 0;
        $playlistToShow = null;
        foreach ($this->items as $item) {
            if ($item->getQuantity() > $maxQuantity && $item->getProduct()->tag && $item->getProduct()->tag->playlist) {
                $maxQuantity = $item->getQuantity();
                $playlistToShow = $item->getProduct()->tag->playlist;
            }
        }
        return $playlistToShow;
    }
    public function calculateTotal(): float
    {
    return $this->items->sum(function ($item) {
        return $item->getPrice() * $item->getQuantity();
    });
    }

}
