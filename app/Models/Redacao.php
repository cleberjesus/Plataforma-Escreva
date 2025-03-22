<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Redacao extends Model
{
    use HasFactory;
    protected $table = 'redacoes';

    protected $fillable = ['tema','modo_envio', 'texto_redacao', 'imagem_redacao', 'data'];

    protected $dates = ['created_at', 'updated_at', 'data'];

}
