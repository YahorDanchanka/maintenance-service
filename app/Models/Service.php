<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Service extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description'];

    public function materials(): BelongsToMany
    {
        return $this->belongsToMany(Material::class)->withPivot('count');
    }

    public function acts(): HasMany
    {
        return $this->hasMany(Act::class);
    }
}
