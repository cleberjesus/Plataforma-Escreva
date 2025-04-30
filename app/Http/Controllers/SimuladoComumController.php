<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SimuladoComumController extends Controller
{
    // Página inicial com cards dos temas
    public function index()
    {
        $temas = $this->getTemas();

        return view('simulado-comum.index', compact('temas'));

    }

    // Página específica de um tema
    public function mostrarTema($slug)
    {
        $temas = $this->getTemas();

        if (!array_key_exists($slug, $temas)) {
            abort(404, 'Tema não encontrado');
        }

        $tema = $temas[$slug];
        $textosMotivadores = $tema['textos'];
        $charges = $tema['charges'] ?? [];

        return view('simulado-comum.tema', compact('slug', 'tema', 'textosMotivadores', 'charges'));
    }

    // Dados dos temas organizados por slug
    private function getTemas()
    {
        return [
            'redes-sociais' => [
                'titulo' => 'O impacto das redes sociais na sociedade moderna',
                'imagem' => 'redes-sociais-vida-moderna.jpg',
                'textos' => [
                    "A internet permitiu uma comunicação global instantânea, mas será que estamos realmente mais conectados?",
                    "As redes sociais revolucionaram a maneira como interagimos, mas trouxeram desafios como a desinformação e a dependência digital."
                ],
                'charges' => [
                    'charge-redes-1.jpg',
                    'charge-redes-2.jpg'
                ]
            ],
            'sustentabilidade-cidades' => [
                'titulo' => 'Os desafios da sustentabilidade nas grandes cidades',
                'imagem' => 'sustentabilidade-cidades-grandes.jpg',
                'textos' => [
                    "Com o crescimento das cidades, encontrar soluções sustentáveis se tornou essencial para o futuro do planeta.",
                    "A poluição e o desperdício de recursos são problemas críticos. Como as cidades podem ser mais verdes?"
                ],
                'charges' => [
                    'charge-sustentabilidade.jpg'
                ]
            ],
            'educacao-financeira' => [
                'titulo' => 'A importância da educação financeira para os jovens',
                'imagem' => 'educacao-financeira.jpg',
                'textos' => [
                    "Muitas pessoas entram na vida adulta sem entender conceitos básicos de finanças. Como isso afeta a economia?",
                    "Investir, poupar e evitar dívidas são desafios que poderiam ser minimizados com educação financeira desde cedo."
                ],
                'charges' => []
            ],
            'inteligencia-artificial' => [
                'titulo' => 'Os efeitos da inteligência artificial no mercado de trabalho',
                'imagem' => 'ia-trabalho.jpg',
                'textos' => [
                    "A automação está substituindo empregos, mas também criando novas oportunidades. Como encontrar equilíbrio?",
                    "Profissões do futuro exigirão novas habilidades. Como devemos nos preparar para essa transição?"
                ],
                'charges' => ['charge-ia.jpg']
            ],
            'tecnologia-inclusao' => [
                'titulo' => 'O papel da tecnologia na inclusão social',
                'imagem' => 'tecnologia-inclusao.jpg',
                'textos' => [
                    "A tecnologia pode eliminar barreiras, mas também criar desigualdades. Como garantir que ela seja inclusiva?",
                    "Ferramentas digitais estão transformando a educação e o trabalho remoto. Como isso impacta grupos marginalizados?"
                ],
                'charges' => []
            ]
        ];
    }
}
