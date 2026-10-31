<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MemberDivisi extends Model
{
    use HasFactory;

    protected $table = 'member_divisies';

    protected $fillable = ['name', 'divisi_id', 'period_id', 'position', 'jurusan', 'image'];

    public function divisi(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Divisi::class, 'divisi_id');
    }
}
