<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProkerComment extends Model
{
    protected $table = 'proker_comments';

    protected $fillable = ['comment', 'user_id', 'proker_id'];

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
