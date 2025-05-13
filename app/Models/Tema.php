<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Tema extends Model
{
    protected $fillable = [
        'slug',
        'titulo',
        'imagem'
    ];

    public function textosMotivadores(): HasMany
    {
        return $this->hasMany(TextoMotivador::class);
    }
}
