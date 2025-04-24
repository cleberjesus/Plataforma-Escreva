<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CronogramaAtividade extends Model
{
    protected $fillable = [
        'cronograma_id', 'data', 'concluido'
    ];

    protected $casts = [
        'data' => 'date',
        'concluido' => 'boolean',
    ];

    public function cronograma()
    {
        return $this->belongsTo(Cronograma::class);
    }
}
