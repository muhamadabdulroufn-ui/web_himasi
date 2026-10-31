<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MemberDivisi extends Model
{
    use HasFactory;

    protected $table = 'member_divisies';

    protected $fillable = ['name', 'foto', 'jabatan', 'jurusan', 'divisi_id'];

    public function divisi(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Divisi::class, 'divisi_id');
    }
}
