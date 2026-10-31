<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailGallery extends Model
{
    use HasFactory;

    protected $table = 'detail_galleries';

    protected $fillable = ['image', 'caption', 'galeri_id'];

    public function galeri(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Gallery::class, 'galeri_id');
    }
}
