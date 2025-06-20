<?php

namespace App\Http\Controllers;

use App\Models\Redacao;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GraficoController extends Controller
{
    public function redacoesPorMes()
    {
        try {
            // Buscar redações do usuário agrupadas por mês
            $dadosPorMes = Redacao::where('user_id', Auth::id())
                ->selectRaw('MONTH(created_at) as mes, YEAR(created_at) as ano, COUNT(*) as total')
                ->groupBy('mes', 'ano')
                ->orderBy('ano', 'asc')
                ->orderBy('mes', 'asc')
                ->get();

            // Preparar dados para o gráfico
            $labels = [];
            $dados = [];

            foreach ($dadosPorMes as $item) {
                $nomeMes = date('M/Y', mktime(0, 0, 0, $item->mes, 1, $item->ano));
                $labels[] = $nomeMes;
                $dados[] = $item->total;
            }

            return view('redacoes.grafico', compact('labels', 'dados'));
        } catch (\Exception $e) {
            // Fallback para caso a consulta SQL falhe
            $redacoes = Redacao::where('user_id', Auth::id())
                ->orderBy('created_at', 'asc')
                ->get();

            $dadosPorMes = [];
            
            foreach ($redacoes as $redacao) {
                $mes = $redacao->created_at->format('M/Y');
                if (!isset($dadosPorMes[$mes])) {
                    $dadosPorMes[$mes] = 0;
                }
                $dadosPorMes[$mes]++;
            }

            $labels = array_keys($dadosPorMes);
            $dados = array_values($dadosPorMes);

            return view('redacoes.grafico', compact('labels', 'dados'));
        }
    }
}
