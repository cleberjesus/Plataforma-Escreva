<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SimuladoCoringaController extends Controller
{
    public function index()
    {
        // Definindo os temas de redação
        $temas = [
            'Impacto das Redes Sociais na Sociedade',
            'Mudanças Climáticas e Seus Efeitos Globais',
            'A Importância da Educação para o Futuro',
            'Desafios e Soluções para a Mobilidade Urbana',
            'O Papel da Tecnologia na Educação Contemporânea'
        ];

        // Gerando um tema aleatório
        $temaAleatorio = $temas[array_rand($temas)];

        // Associando textos motivadores mais longos ao tema
        $textosMotivadores = [
            'Impacto das Redes Sociais na Sociedade' => [
                "As redes sociais têm transformado de forma irreversível nossa maneira de interagir. As plataformas sociais são ferramentas poderosas de comunicação, permitindo que as pessoas se conectem instantaneamente, mas também trazendo à tona questões sobre privacidade e saúde mental. Ao refletir sobre este tema, pense nos efeitos das redes sociais na vida das pessoas, tanto positivamente quanto negativamente.",
                "A explosão de plataformas digitais criou novas formas de influência, mas também gerou novos problemas como as fake news e a manipulação de informações. Como você pode entender e analisar esse impacto de forma crítica? Será que as redes sociais ainda têm o poder de unir as pessoas de maneira saudável ou elas estão mais separando do que conectando?",
                "Por outro lado, as redes sociais também podem servir como um campo de expressão cultural, oferecendo às pessoas uma plataforma para compartilhar suas experiências, talentos e ideias. Analise as diferentes perspectivas sobre as redes sociais, considerando tanto suas potencialidades quanto os riscos associados a elas."
            ],
            'Mudanças Climáticas e Seus Efeitos Globais' => [
                "As mudanças climáticas são uma das maiores ameaças que a humanidade já enfrentou. O aumento das temperaturas globais tem causado eventos climáticos extremos, como secas severas, enchentes e furacões, afetando milhões de pessoas ao redor do mundo. Como podemos lidar com essas mudanças de forma eficaz, adotando estratégias que não só mitiguem os efeitos, mas também promovam uma adaptação mais resiliente?",
                "O impacto das mudanças climáticas afeta todos os aspectos de nossas vidas, desde a agricultura até a saúde pública. Qual é o papel dos governos e das empresas na promoção de práticas mais sustentáveis? E o que podemos, como indivíduos, fazer para contribuir com um futuro mais equilibrado e menos impactado pelas ações humanas?",
                "Essas alterações não afetam apenas os países mais pobres, mas estão se tornando uma ameaça global que precisa de soluções urgentes. Pense em possíveis políticas globais que poderiam ser implementadas para combater os efeitos do aquecimento global, bem como alternativas tecnológicas que poderiam mitigar esses impactos."
            ],
            'A Importância da Educação para o Futuro' => [
                "A educação é o pilar de toda sociedade, sendo uma das ferramentas mais poderosas para transformar vidas. Através da educação, podemos promover a igualdade social, oferecendo a todos as mesmas oportunidades para crescer e desenvolver habilidades essenciais para a vida. Quais são os principais desafios que as escolas enfrentam hoje e como podemos resolvê-los?",
                "Além disso, a educação não deve ser limitada às paredes da sala de aula, mas deve abranger o desenvolvimento de habilidades práticas, emocionais e cognitivas. Em um mundo em constante mudança, como podemos garantir que a educação esteja preparada para preparar as gerações futuras para os desafios que virão?",
                "É importante refletir também sobre o papel da tecnologia na educação moderna. A tecnologia tem sido um facilitador na maneira como aprendemos, tornando o conhecimento mais acessível. Mas, será que ela pode substituir o ensino tradicional? Qual é o equilíbrio ideal entre o aprendizado digital e o físico?"
            ],
            'Desafios e Soluções para a Mobilidade Urbana' => [
                "O crescimento das cidades e o aumento do número de veículos nas ruas têm gerado sérios desafios para a mobilidade urbana. Engarrafamentos constantes e o aumento da poluição do ar são apenas alguns dos problemas que as grandes cidades enfrentam. Como podemos melhorar a qualidade do transporte público e reduzir o número de carros nas ruas?",
                "Além disso, a mobilidade urbana não deve se concentrar apenas na eficiência do transporte, mas também na inclusão. Como garantir que as cidades sejam acessíveis para todos, incluindo pessoas com deficiência ou de classes sociais mais baixas? Quais soluções tecnológicas podem ser aplicadas para tornar as cidades mais inteligentes e sustentáveis?",
                "A mobilidade urbana é, sem dúvida, um dos maiores desafios urbanos do século XXI. A criação de sistemas de transporte mais eficientes e sustentáveis é uma tarefa urgente que exige a colaboração entre governos, empresas e cidadãos."
            ],
            'O Papel da Tecnologia na Educação Contemporânea' => [
                "A tecnologia tem desempenhado um papel fundamental na transformação da educação. Ferramentas como plataformas de ensino online, aplicativos educativos e recursos digitais têm ampliado o acesso à educação, permitindo que alunos de diferentes partes do mundo tenham acesso ao mesmo conteúdo e conhecimentos.",
                "Contudo, a integração da tecnologia na educação também traz desafios. Como garantir que a tecnologia seja usada de forma eficaz e não apenas como uma ferramenta de distração? Quais são as melhores práticas para incorporar o ensino digital no processo educacional de maneira equilibrada?",
                "A tecnologia também tem o potencial de personalizar a educação, adaptando os métodos de ensino às necessidades de cada aluno. Mas será que a educação baseada em tecnologia pode substituir a experiência tradicional de aprender com um professor? O que é mais importante: a conexão humana ou o acesso à informação digital?"
            ]
        ];

        // Selecionando os textos motivadores do tema aleatório
        $textosMotivadoresTema = $textosMotivadores[$temaAleatorio];

        // Definindo imagens associadas aos temas
        $imagens = [
            'Impacto das Redes Sociais na Sociedade' => 'https://example.com/imagens/redes_sociais.jpg',
            'Mudanças Climáticas e Seus Efeitos Globais' => 'https://example.com/imagens/mudancas_climaticas.jpg',
            'A Importância da Educação para o Futuro' => 'https://example.com/imagens/educacao.jpg',
            'Desafios e Soluções para a Mobilidade Urbana' => 'https://example.com/imagens/mobilidade.jpg',
            'O Papel da Tecnologia na Educação Contemporânea' => 'https://example.com/imagens/tecnologia.jpg'
        ];

        // Pegando a imagem associada ao tema
        $imagemBase = $imagens[$temaAleatorio];

        // Definindo o tempo limite baseado no nível (aqui fixado para 'Intermediário' por simplicidade)
        $nivel = 'Intermediário'; // Pode ser passado como parâmetro ou obtido via autenticação
        $tempos = [
            'Iniciante' => 60,   // 1 hora em minutos
            'Intermediário' => 40, // 40 minutos
            'Avançado' => 20    // 20 minutos
        ];
        $tempoLimite = $tempos[$nivel];

        // Passando as variáveis para a view
        return view('simulado-coringa', [
            'tema' => $temaAleatorio,
            'textosMotivadores' => $textosMotivadoresTema,
            'imagemBase' => $imagemBase,
            'tempoLimite' => $tempoLimite
        ]);
    }
}
