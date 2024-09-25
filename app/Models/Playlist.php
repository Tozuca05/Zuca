<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Tag;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use App\Models\Order;

class Playlist extends Model
{
    /**
     * PLAYLIST ATTRIBUTES
     * $this->attributes['id'] - int - contains the playlist primary key (id)
     * $this->attributes['name'] - string - contains the playlist name
     * $this->attributes['link'] - string - contains the playlist link
     * $this->attributes['image_url'] - string - contains the playlist image URL
     * $this->attributes['tag_id'] - int - contains the id of the associated tag
     * $this->attributes['created_at'] - timestamp - contains the playlist creation date
     * $this->attributes['updated_at'] - timestamp - contains the playlist update date
     */

    public function tag(): BelongsTo
    {
        return $this->belongsTo(Tag::class);
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

    public function getLink(): string
    {
        return $this->attributes['link'];
    }

    public function setLink(string $link): void
    {
        $this->attributes['link'] = $link;
    }

    public function getImageUrl(): string
    {
        return $this->attributes['image_url'];
    }

    public function setImageUrl(string $imageUrl): void
    {
        $this->attributes['image_url'] = $imageUrl;
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
            'link' => 'required|url',
            'image_url' => 'nullable|url',
            'tag_id' => 'required|exists:tags,id',
        ]);
    }

    public function orders(): BelongsToMany
    {
        return $this->belongsToMany(Order::class);
    }

    public function getCreatedAt(): string
    {
        return $this->attributes['created_at'];
    }

    public function getTag(): Tag
    {
        return $this->tag();
    }
}