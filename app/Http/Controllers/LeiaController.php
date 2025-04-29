<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class LeiaController extends Controller
{
    public function mostrarLeituras()
    {
        $noticias = []; // Inicializando a variável como um array vazio

        try {
            // Desabilitar a verificação SSL para desenvolvimento local
            $response = Http::withOptions([
                'verify' => false,  // Ignora a verificação do certificado SSL
            ])->get('https://newsapi.org/v2/top-headlines', [
                'country'  => 'br',
                'category' => 'general',
                'pageSize' => 10,
                'apiKey'   => config('services.newsapi.key'),
            ]);

            // Verifica se a resposta contém artigos e atribui à variável
            $noticias = $response->json('articles', []);
            
            // Se não houver notícias, podemos passar uma mensagem para a view
            if (empty($noticias)) {
                $mensagem = 'Não foram carregadas notícias.';
            }
        } catch (\Exception $e) {
            // Caso haja um erro, passa uma mensagem para a view
            $mensagem = 'Erro ao carregar as notícias: ' . $e->getMessage();
        }

        // Retorna a view com os dados ou a mensagem
        return view('leia.index', compact('noticias', 'mensagem'));
    }
}
