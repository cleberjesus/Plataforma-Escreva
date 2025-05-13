<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TextoMotivador extends Model
{
    protected $table = 'textos_motivadores';

    protected $fillable = [
        'tema_id',
        'texto',
        'charge'
    ];

    public function tema(): BelongsTo
    {
        return $this->belongsTo(Tema::class);
    }
}
