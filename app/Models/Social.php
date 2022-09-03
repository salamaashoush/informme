<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Social extends Model
{
    protected $table = 'social_logins';
    protected $fillable = ['provider','social_id','user_id'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
