<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Social extends Model
{
    protected $table = 'social_logins';

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
