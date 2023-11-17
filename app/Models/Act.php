<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Act extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'address', 'date', 'service_id', 'expert_id'];

    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class);
    }

    public function expert(): BelongsTo
    {
        return $this->belongsTo(Expert::class);
    }
}
