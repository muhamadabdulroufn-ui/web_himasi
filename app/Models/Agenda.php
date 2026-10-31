<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agenda extends Model
{
    use HasFactory;

    protected $table = 'agendas';

    protected $fillable = [
        'title',
        'slug',
        'description',
        'location',
        'date_start',
        'date_end',
        'image',
    ];

    public function getNameAttribute($value)
    {
        return $value ?? $this->attributes['title'] ?? null;
    }

    public function getAddressAttribute($value)
    {
        return $value ?? $this->attributes['location'] ?? null;
    }

    public function getDateAttribute($value)
    {
        return $value ?? $this->attributes['date_start'] ?? null;
    }

    public function getThumbnailAttribute($value)
    {
        return $value ?? $this->attributes['image'] ?? null;
    }
}
