<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'date', 'thumbnail'];

    public function detail_galeri(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(DetailGallery::class, 'galeri_id');
    }
}
