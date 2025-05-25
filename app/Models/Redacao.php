<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Redacao extends Model
{
    use HasFactory;
    protected $table = 'redacoes';

    protected $fillable = [
        'tema',
        'modo_envio', 
        'texto_redacao', 
        'imagem_redacao',
        'tempo_gasto',
        'nota_comp1',
        'nota_comp2',
        'nota_comp3',
        'nota_comp4',
        'nota_comp5',
        'nota_total',
        'comentario',
        'corrigida'
    ];
    
    protected $dates = ['created_at', 'updated_at'];

    protected $casts = [
        'corrigida' => 'boolean',
        'nota_comp1' => 'decimal:1',
        'nota_comp2' => 'decimal:1',
        'nota_comp3' => 'decimal:1',
        'nota_comp4' => 'decimal:1',
        'nota_comp5' => 'decimal:1',
        'nota_total' => 'decimal:1',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
