<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Correcao extends Model
{
    protected $fillable = [
        'id',
        'nota',
        'feedback',
        'user_id',
        'redacao_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function redacao()
    {
        return $this->belongsTo(Redacao::class);
    }
}
