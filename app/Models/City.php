<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class City extends Model
{
    use HasFactory;
    
    protected $fillable = ['name', 'area', 'gover_id', 'is_division', 'districts', 'divisions', 'units', 'population', 'p_density_rate', 'creation_date', 'national_day', 'description'];

    public function division(): BelongsTo
    {
        return $this->belongsTo(Division::class, 'div_id');
    }

    public function governorate(): BelongsTo
    {
        return $this->belongsTo(Governorate::class, 'gover_id');
    }

    public function photos(): MorphMany
    {
        return $this->morphMany(Photo::class, 'imageable');
    }

    public function articles(): MorphMany
    {
        return $this->morphMany(Article::class, 'articlable');
    }

    public function edit_route(): string
    {
        return 'cities.edit';
    }
}
