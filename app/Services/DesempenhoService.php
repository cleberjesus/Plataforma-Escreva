<?php

namespace App\Services;

use App\Models\Desempenho;
use App\Models\Redacao;

class DesempenhoService
{
    public function atualizarDesempenho($userId)
    {
        // Busca todas as redações corrigidas do usuário
        $redacoes = Redacao::where('user_id', $userId)
            ->where('corrigida', true)
            ->get();

        if ($redacoes->isEmpty()) {
            return;
        }

        // Calcula as médias
        $totalRedacoes = $redacoes->count();
        $mediaGeral = $redacoes->avg('nota_total');
        $mediaComp1 = $redacoes->avg('nota_comp1');
        $mediaComp2 = $redacoes->avg('nota_comp2');
        $mediaComp3 = $redacoes->avg('nota_comp3');
        $mediaComp4 = $redacoes->avg('nota_comp4');
        $mediaComp5 = $redacoes->avg('nota_comp5');
        $tempoMedio = $redacoes->avg('tempo_gasto');

        // Atualiza ou cria o registro de desempenho
        Desempenho::updateOrCreate(
            ['user_id' => $userId],
            [
                'total_redacoes' => $totalRedacoes,
                'media_geral' => $mediaGeral,
                'media_comp1' => $mediaComp1,
                'media_comp2' => $mediaComp2,
                'media_comp3' => $mediaComp3,
                'media_comp4' => $mediaComp4,
                'media_comp5' => $mediaComp5,
                'tempo_medio' => $tempoMedio
            ]
        );
    }
} 