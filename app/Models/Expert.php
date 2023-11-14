<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Expert extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'surname', 'patronymic', 'rank', 'hire_date', 'phone'];

    protected function fullName(): Attribute
    {
        return Attribute::make(
            get: fn () => ucfirst($this->surname) . ' ' . ucfirst($this->name) . ' ' . ucfirst($this->patronymic ?? ''),
        );
    }
}
