<?php

namespace App\Observers;

use App\Models\Redacao;
use App\Services\DesempenhoService;

class RedacaoObserver
{
    protected $desempenhoService;

    public function __construct(DesempenhoService $desempenhoService)
    {
        $this->desempenhoService = $desempenhoService;
    }

    public function updated(Redacao $redacao)
    {
        // Verifica se alguma nota foi alterada
        if ($redacao->isDirty([
            'nota_comp1',
            'nota_comp2',
            'nota_comp3',
            'nota_comp4',
            'nota_comp5'
        ])) {
            $this->desempenhoService->atualizarDesempenho($redacao->user_id);
        }
    }
} 