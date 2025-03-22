<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SimuladoComumController extends Controller
{
    public function index()
    {
        $temas = [
            "O impacto das redes sociais na sociedade moderna",
            "Os desafios da sustentabilidade nas grandes cidades",
            "A importância da educação financeira para os jovens",
            "Os efeitos da inteligência artificial no mercado de trabalho",
            "O papel da tecnologia na inclusão social"
        ];

        $textosMotivadores = [
            "O impacto das redes sociais na sociedade moderna" => [
                "A internet permitiu uma comunicação global instantânea, mas será que estamos realmente mais conectados?",
                "As redes sociais revolucionaram a maneira como interagimos, mas trouxeram desafios como a desinformação e a dependência digital."
            ],
            "Os desafios da sustentabilidade nas grandes cidades" => [
                "Com o crescimento das cidades, encontrar soluções sustentáveis se tornou essencial para o futuro do planeta.",
                "A poluição e o desperdício de recursos são problemas críticos. Como as cidades podem ser mais verdes?"
            ],
            "A importância da educação financeira para os jovens" => [
                "Muitas pessoas entram na vida adulta sem entender conceitos básicos de finanças. Como isso afeta a economia?",
                "Investir, poupar e evitar dívidas são desafios que poderiam ser minimizados com educação financeira desde cedo."
            ],
            "Os efeitos da inteligência artificial no mercado de trabalho" => [
                "A automação está substituindo empregos, mas também criando novas oportunidades. Como encontrar equilíbrio?",
                "Profissões do futuro exigirão novas habilidades. Como devemos nos preparar para essa transição?"
            ],
            "O papel da tecnologia na inclusão social" => [
                "A tecnologia pode eliminar barreiras, mas também criar desigualdades. Como garantir que ela seja inclusiva?",
                "Ferramentas digitais estão transformando a educação e o trabalho remoto. Como isso impacta grupos marginalizados?"
            ]
        ];

        return view('simulado-comum', compact('temas', 'textosMotivadores'));
    }
}
