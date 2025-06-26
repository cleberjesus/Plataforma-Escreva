<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Redacao extends Model
{
    use HasFactory;
    protected $table = 'redacoes';

    protected $fillable = [
        'id',
        'tema',
        'modo_envio', 
        'texto_redacao', 
        'imagem_redacao',
        'tempo_gasto',
        'nota',
        'feedback',
        'corrigida'
    ];
    
    protected $dates = ['created_at', 'updated_at'];

    protected $casts = [
        'corrigida' => 'boolean',
        'nota' => 'decimal:1',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
