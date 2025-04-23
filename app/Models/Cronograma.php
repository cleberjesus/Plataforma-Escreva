<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cronograma extends Model
{
    // Atributos que podem ser preenchidos
    protected $fillable = [
        'user_id', 'titulo', 'dias_da_semana', 'inicio', 'fim'
    ];

    // Cast para garantir que 'dias_da_semana' seja tratado como array e as datas como tipo 'date'
    protected $casts = [
        'dias_da_semana' => 'array',
        'inicio' => 'date',
        'fim' => 'date',
    ];

    // Relacionamento com o modelo User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
