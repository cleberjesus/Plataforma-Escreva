<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Desempenho extends Model
{
    use HasFactory;

    protected $table = 'desempenhos';

    protected $fillable = [
        'user_id',
        'total_redacoes',
        'media_geral',
        'media_comp1',
        'media_comp2',
        'media_comp3',
        'media_comp4',
        'media_comp5',
        'tempo_medio'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
} 