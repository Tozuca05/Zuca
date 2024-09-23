<?php 
 
namespace App\Models; 
 
use Illuminate\Database\Eloquent\Model; 
use App\Models\User; 
use App\Models\Item; 
 
class Order extends Model 
{ 
    /** 
     * ORDER ATTRIBUTES 
     * $this->attributes['id'] - int - contains the order primary key (id) 
     * $this->attributes['total'] - string - contains the order name 
     * $this->attributes['user_id'] - int - contains the referenced user id 
     * $this->attributes['created_at'] - timestamp - contains the order creation date 
     * $this->attributes['updated_at'] - timestamp - contains the order update date 
     * $this->user - User - contains the associated User 
     * $this->items - Item[] - contains the associated items 
     */ 
 
    public static function validate($request): void
    { 
        $request->validate([ 
            "total" => "required|numeric", 
            "user_id" => "required|exists:users,id", 
        ]); 
    } 
     
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
 
    public function getUserId(): int
    { 
        return $this->attributes['user_id']; 
    } 
 
    public function setUserId(int $userId): void
    { 
        $this->attributes['user_id'] = $userId; 
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
 
    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
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

    public function items(): \Illuminate\Database\Eloquent\Relations\HasMany
    { 
        return $this->hasMany(Item::class); 
    } 

    public function getItems(): \Illuminate\Database\Eloquent\Collection
    { 
        return $this->items; 
    } 

    public function setItems(\Illuminate\Database\Eloquent\Collection $items): void
    { 
        $this->items = $items; 
    } 
}