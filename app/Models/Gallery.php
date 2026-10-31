<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'slug', 'description', 'cover', 'date'];

    public function getNameAttribute($value)
    {
        return $value ?? $this->attributes['title'] ?? null;
    }

    public function getThumbnailAttribute($value)
    {
        return $value ?? $this->attributes['cover'] ?? null;
    }

    public function detail_galeri(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(DetailGallery::class, 'galeri_id');
    }
}
