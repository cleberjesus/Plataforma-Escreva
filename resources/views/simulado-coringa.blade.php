@extends('layouts.app')

@section('content')
<div id="simulado-coringa-app" class="min-h-screen bg-gradient-to-br from-blue-50 to-indigo-100">
    <audio id="audio-contagem" src="/sounds/contagem3.wav" preload="auto"></audio>
    <div class="container mx-auto px-4 py-6">
        <!-- Header -->
        <div class="mb-6">
            <button @click="voltar()" class="flex items-center text-blue-600 hover:text-blue-800 transition-colors duration-200 mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
                <span class="font-medium">Voltar</span>
            </button>
            
            <h1 class="text-3xl md:text-4xl font-bold text-center text-gray-800 mb-2">
                🃏 Simulado Coringa
            </h1>
            <p class="text-center text-gray-600 text-lg">
                Teste sua criatividade com temas surpresa!
            </p>
        </div>

        <!-- Modal de Avaliação de Nível -->
        <div v-if="showNivelModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 p-4">
            <div class="bg-white rounded-2xl shadow-2xl max-w-md w-full p-6">
                <div class="text-center mb-6">
                    <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-2">Avaliação de Nível</h3>
                    <p class="text-gray-600">Vamos personalizar sua experiência!</p>
                </div>

                <form @submit.prevent="definirNivel" class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Qual sua experiência com redação?
                        </label>
                        <select v-model="avaliacao.experiencia" class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            <option value="">Selecione...</option>
                            <option value="iniciante">Nenhuma experiência</option>
                            <option value="intermediario">Já escrevi algumas redações</option>
                            <option value="avancado">Escrevo frequentemente</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Com que frequência você escreve redações?
                        </label>
                        <select v-model="avaliacao.frequencia" class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            <option value="">Selecione...</option>
                            <option value="iniciante">Raramente</option>
                            <option value="intermediario">Uma vez por mês</option>
                            <option value="avancado">Toda semana</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Como avalia seu conhecimento em técnicas de redação?
                        </label>
                        <select v-model="avaliacao.conhecimento" class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            <option value="">Selecione...</option>
                            <option value="iniciante">Baixo</option>
                            <option value="intermediario">Médio</option>
                            <option value="avancado">Alto</option>
                        </select>
                    </div>

                    <button type="submit" class="w-full bg-blue-600 text-white py-3 px-4 rounded-lg font-medium hover:bg-blue-700 transition-colors duration-200">
                        Começar Simulado
                    </button>
                </form>
            </div>
        </div>

        <!-- Card de Boas-Vindas -->
        <div v-if="showInicioCard" class="max-w-4xl mx-auto">
            <div class="bg-white rounded-2xl shadow-xl p-8 mb-6">
                <div class="grid md:grid-cols-2 gap-8 items-center">
                    <div>
                        <h2 class="text-2xl font-bold text-gray-800 mb-4">🎯 Prepare-se para o desafio!</h2>
                        <ul class="space-y-3 text-gray-700">
                            <li class="flex items-center">
                                <span class="w-2 h-2 bg-blue-500 rounded-full mr-3"></span>
                                Pegue papel e caneta
                            </li>
                            <li class="flex items-center">
                                <span class="w-2 h-2 bg-blue-500 rounded-full mr-3"></span>
                                Prepare um ambiente calmo
                            </li>
                            <li class="flex items-center">
                                <span class="w-2 h-2 bg-blue-500 rounded-full mr-3"></span>
                                Respire fundo
                            </li>
                            <li class="flex items-center">
                                <span class="w-2 h-2 bg-blue-500 rounded-full mr-3"></span>
                                Este é seu momento de treino!
                            </li>
                            <li class="flex items-center">
                                <span class="w-2 h-2 bg-blue-500 rounded-full mr-3"></span>
                                Você é capaz, acredite!
                            </li>
                            <li class="flex items-center">
                                <span class="w-2 h-2 bg-blue-500 rounded-full mr-3"></span>
                                Aquela nota 1000 do ENEM é sua!
                            </li>
                        </ul>
                    </div>
                    
                    <div class="text-center">
                        <div class="mb-6">
                            <div class="w-24 h-24 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4">
                                <svg class="w-12 h-12 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                                </svg>
                            </div>
                            <p class="text-lg font-semibold text-gray-700 mb-4">
                                Você está pronto para começar o simulado?
                            </p>
                            <p class="text-sm text-gray-600 mb-6">
                                Tempo disponível: <span class="font-bold text-blue-600">@{{ formatarTempo(tempoLimite) }}</span>
                            </p>
                        </div>
                        
                        <button @click="iniciarContagem" class="bg-gradient-to-r from-blue-600 to-blue-700 text-white px-8 py-4 rounded-full font-semibold text-lg hover:from-blue-700 hover:to-blue-800 transition-all duration-300 transform hover:scale-105 shadow-lg">
                            🚀 Iniciar Simulado
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Contagem Regressiva -->
        <div v-if="showContagem" class="fixed inset-0 bg-black bg-opacity-75 flex items-center justify-center z-50">
            <div class="text-center">
                <div class="text-8xl md:text-9xl font-bold text-white mb-4 animate-pulse">
                    @{{ contador }}
                </div>
                <p class="text-white text-xl">Prepare-se...</p>
            </div>
        </div>

        <!-- Conteúdo Principal do Simulado -->
        <div v-if="showSimulado" class="max-w-6xl mx-auto">
            <div class="grid lg:grid-cols-3 gap-6">
                <!-- Área do Tema -->
                <div class="lg:col-span-2">
                    <div class="bg-white rounded-2xl shadow-xl p-6">
                        <div v-if="temaAtual" class="space-y-6">
                            <!-- Tema -->
                            <div class="border-b border-gray-200 pb-4">
                                <h3 class="text-sm font-medium text-gray-500 mb-2">TEMA DA REDAÇÃO</h3>
                                <h2 class="text-xl md:text-2xl font-bold text-gray-800 leading-relaxed">
                                    @{{ temaAtual.tema }}
                                </h2>
                            </div>

                            <!-- Imagem do Tema -->
                            <div v-if="temaAtual.imagem" class="text-center">
                                <img :src="'/images/temas/' + temaAtual.imagem" 
                                     alt="Imagem do tema" 
                                     class="max-w-full h-auto max-h-64 object-contain rounded-lg shadow-md mx-auto">
                            </div>

                            <!-- Textos Motivadores -->
                            <div v-if="temaAtual.textos && temaAtual.textos.length > 0" class="space-y-4">
                                <h3 class="text-lg font-semibold text-gray-800 mb-3">TEXTOS MOTIVADORES</h3>
                                <div class="grid md:grid-cols-2 gap-4">
                                    <div v-for="(texto, index) in temaAtual.textos" :key="index" 
                                         class="bg-gray-50 p-4 rounded-lg border-l-4 border-blue-500">
                                        <h4 class="font-semibold text-blue-700 mb-2">
                                            Texto Motivador @{{ index + 1 }}
                                        </h4>
                                        <p class="text-gray-700 text-sm leading-relaxed whitespace-pre-line">
                                            @{{ texto }}
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <!-- Charges -->
                            <div v-if="temaAtual.charges && temaAtual.charges.length > 0" class="space-y-4">
                                <h3 class="text-lg font-semibold text-gray-800 mb-3">CHARGES</h3>
                                <div class="grid md:grid-cols-2 gap-4">
                                    <div v-for="(charge, index) in temaAtual.charges" :key="index" 
                                         class="text-center">
                                        <img :src="'/images/temas/' + charge" 
                                             :alt="'Charge ' + (index + 1)" 
                                             class="max-w-full h-auto rounded-lg shadow-md">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Timer e Controles -->
                <div class="lg:col-span-1">
                    <div class="sticky top-6">
                        <!-- Timer -->
                        <div class="bg-white rounded-2xl shadow-xl p-6 mb-6">
                            <div class="text-center">
                                <div class="relative w-32 h-32 mx-auto mb-4">
                                    <svg class="w-full h-full transform -rotate-90" viewBox="0 0 100 100">
                                        <circle cx="50" cy="50" r="45" 
                                                stroke="#e5e7eb" stroke-width="8" fill="none"/>
                                        <circle cx="50" cy="50" r="45" 
                                                stroke="#3b82f6" stroke-width="8" fill="none"
                                                :stroke-dasharray="circunferencia"
                                                :stroke-dashoffset="strokeDashoffset"
                                                stroke-linecap="round"
                                                class="transition-all duration-1000"/>
                                    </svg>
                                    <div class="absolute inset-0 flex items-center justify-center">
                                        <div class="text-center">
                                            <div class="text-2xl font-bold text-gray-800">
                                                @{{ formatarTempo(tempoRestante) }}
                                            </div>
                                            <div class="text-xs text-gray-500">restante</div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div v-if="fraseMotivacional" class="bg-blue-50 p-3 rounded-lg">
                                    <p class="text-blue-700 text-sm font-medium">
                                        💪 @{{ fraseMotivacional }}
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- Controles -->
                        <div class="bg-white rounded-2xl shadow-xl p-6">
                            <h3 class="text-lg font-semibold text-gray-800 mb-4">Controles</h3>
                            <div class="space-y-3">
                                <button @click="pausarTimer" 
                                        v-if="!timerPausado" 
                                        class="w-full bg-yellow-500 text-white py-3 px-4 rounded-lg font-medium hover:bg-yellow-600 transition-colors duration-200">
                                    ⏸️ Pausar
                                </button>
                                <button @click="retomarTimer" 
                                        v-if="timerPausado" 
                                        class="w-full bg-green-500 text-white py-3 px-4 rounded-lg font-medium hover:bg-green-600 transition-colors duration-200">
                                    ▶️ Retomar
                                </button>
                                <button @click="finalizarSimulado" 
                                        class="w-full bg-red-500 text-white py-3 px-4 rounded-lg font-medium hover:bg-red-600 transition-colors duration-200">
                                    🏁 Finalizar
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal de Tempo Esgotado -->
        <div v-if="showModalTempoEsgotado" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 p-4">
            <div class="bg-white rounded-2xl shadow-2xl max-w-md w-full p-6">
                <div class="text-center">
                    <div class="w-16 h-16 bg-yellow-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-2">Tempo Esgotado!</h3>
                    <p class="text-gray-600 mb-6">
                        Não se preocupe! O importante é que você praticou. 
                        Que tal revisar sua redação agora?
                    </p>
                    <div class="space-y-3">
                        <button @click="salvarRedacao" 
                                class="w-full bg-blue-600 text-white py-3 px-4 rounded-lg font-medium hover:bg-blue-700 transition-colors duration-200">
                            💾 Salvar Redação
                        </button>
                        <button @click="novoSimulado" 
                                class="w-full bg-green-600 text-white py-3 px-4 rounded-lg font-medium hover:bg-green-700 transition-colors duration-200">
                            🔄 Iniciar Novo Simulado
                        </button>
                        <button @click="voltar" 
                                class="w-full bg-gray-200 text-gray-800 py-3 px-4 rounded-lg font-medium hover:bg-gray-300 transition-colors duration-200">
                            🏠 Voltar ao Início
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Scripts -->
<script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>
<script>
const { createApp } = Vue;

createApp({
    data() {
        return {
            // Estados da aplicação
            showNivelModal: true,
            showInicioCard: false,
            showContagem: false,
            showSimulado: false,
            showModalTempoEsgotado: false,
            
            // Timer
            tempoLimite: 3600,
            tempoRestante: 3600,
            timerPausado: false,
            timerInterval: null,
            motivacaoInterval: null,
            
            // Contagem regressiva
            contador: 5,
            
            // Tema atual
            temaAtual: null,
            
            // Avaliação de nível
            avaliacao: {
                experiencia: '',
                frequencia: '',
                conhecimento: ''
            },
            
            // Frases motivacionais
            frasesMotivacionais: [
                "Continue assim! Você está indo muito bem!",
                "Mantenha o foco, falta pouco!",
                "Você consegue, sua evolução tá vindo!",
                "A constância vai te levar à nota 1000!",
                "Respira fundo, você tá no caminho certo!",
                "Cada palavra é um passo para o sucesso!",
                "Você está escrevendo seu futuro!",
                "A persistência é a chave do sucesso!"
            ],
            fraseMotivacional: '',
            
            // Constantes
            circunferencia: 2 * Math.PI * 45
        }
    },
    
    computed: {
        strokeDashoffset() {
            const progresso = this.tempoRestante / this.tempoLimite;
            return this.circunferencia * (1 - progresso);
        }
    },
    
    methods: {
        // Navegação
        voltar() {
            window.location.href = "{{ route('dashboard') }}";
        },
        
        // Avaliação de nível
        definirNivel() {
            if (!this.avaliacao.experiencia || !this.avaliacao.frequencia || !this.avaliacao.conhecimento) {
                alert('Por favor, preencha todos os campos.');
                return;
            }
            
            // Define o tempo baseado na avaliação
            const niveis = [this.avaliacao.experiencia, this.avaliacao.frequencia, this.avaliacao.conhecimento];
            const nivelContagem = {
                iniciante: niveis.filter(n => n === 'iniciante').length,
                intermediario: niveis.filter(n => n === 'intermediario').length,
                avancado: niveis.filter(n => n === 'avancado').length
            };
            
            if (nivelContagem.avancado >= 2) {
                this.tempoLimite = 1200; // 20 minutos
            } else if (nivelContagem.intermediario >= 2) {
                this.tempoLimite = 2100; // 35 minutos
            } else {
                this.tempoLimite = 3600; // 60 minutos
            }
            
            this.tempoRestante = this.tempoLimite;
            this.showNivelModal = false;
            this.showInicioCard = true;
        },
        
        // Início do simulado
        iniciarContagem() {
            this.showInicioCard = false;
            this.showContagem = true;
            const audio = document.getElementById('audio-contagem');
            const contagemInterval = setInterval(() => {
                if (audio) {
                    audio.currentTime = 0;
                    audio.play();
                }
                this.contador--;
                if (this.contador <= 0) {
                    clearInterval(contagemInterval);
                    this.showContagem = false;
                    this.showSimulado = true;
                    this.gerarTema();
                    this.iniciarTimer();
                }
            }, 1000);
        },
        
        // Geração de tema
        async gerarTema() {
            try {
                const response = await fetch("{{ route('simulado-coringa.gerarTema') }}");
                const data = await response.json();
                
                if (response.ok) {
                    this.temaAtual = data;
                } else {
                    throw new Error(data.error || 'Erro ao gerar tema');
                }
            } catch (error) {
                console.error('Erro ao gerar tema:', error);
                alert('Erro ao gerar o tema. Tente novamente.');
            }
        },
        
        // Timer
        iniciarTimer() {
            this.timerInterval = setInterval(() => {
                if (!this.timerPausado && this.tempoRestante > 0) {
                    this.tempoRestante--;
                    
                    if (this.tempoRestante <= 0) {
                        this.finalizarPorTempo();
                    }
                }
            }, 1000);
            
            this.motivacaoInterval = setInterval(() => {
                this.exibirMotivacao();
            }, 30000); // A cada 30 segundos
            
            this.exibirMotivacao();
        },
        
        pausarTimer() {
            this.timerPausado = true;
        },
        
        retomarTimer() {
            this.timerPausado = false;
        },
        
        finalizarSimulado() {
            if (confirm('Tem certeza que deseja finalizar o simulado?')) {
                this.finalizarPorTempo();
            }
        },
        
        finalizarPorTempo() {
            clearInterval(this.timerInterval);
            clearInterval(this.motivacaoInterval);
            this.showSimulado = false;
            this.showModalTempoEsgotado = true;
        },
        
        exibirMotivacao() {
            const frase = this.frasesMotivacionais[Math.floor(Math.random() * this.frasesMotivacionais.length)];
            this.fraseMotivacional = frase;
            
            // Remove a frase após 5 segundos
            setTimeout(() => {
                if (this.fraseMotivacional === frase) {
                    this.fraseMotivacional = '';
                }
            }, 5000);
        },
        
        // Salvamento
        async salvarRedacao() {
            try {
                const response = await fetch("{{ route('simulado-coringa.salvarRedacao') }}", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({
                        texto: 'Redação do simulado coringa',
                        tema: this.temaAtual?.tema || 'Tema não definido',
                        tempo_gasto: this.tempoLimite - this.tempoRestante
                    })
                });
                
                const data = await response.json();
                
                if (response.ok) {
                    alert('Redação salva com sucesso!');
                    this.voltar();
                } else {
                    throw new Error(data.message || 'Erro ao salvar redação');
                }
            } catch (error) {
                console.error('Erro ao salvar redação:', error);
                alert('Erro ao salvar a redação. Tente novamente.');
            }
        },
        
        novoSimulado() {
            this.showModalTempoEsgotado = false;
            this.resetarSimulado();
            this.showNivelModal = true;
        },
        
        resetarSimulado() {
            this.tempoRestante = this.tempoLimite;
            this.timerPausado = false;
            this.temaAtual = null;
            this.fraseMotivacional = '';
            this.contador = 5;
        },
        
        // Utilitários
        formatarTempo(segundos) {
            const minutos = Math.floor(segundos / 60);
            const segs = segundos % 60;
            return `${minutos.toString().padStart(2, '0')}:${segs.toString().padStart(2, '0')}`;
        }
    },
    
    mounted() {
        // Verificar se o usuário já tem um nível definido
        const userNivel = "{{ auth()->user()->nivel ?? 'iniciante' }}";
        const temposPorNivel = {
            'iniciante': 3600,
            'intermediario': 2100,
            'avancado': 1200
        };
        
        if (userNivel && temposPorNivel[userNivel]) {
            this.tempoLimite = temposPorNivel[userNivel];
            this.tempoRestante = this.tempoLimite;
        }
    }
}).mount('#simulado-coringa-app');
</script>

<style scoped>
.animate-pulse {
    animation: pulse 1s cubic-bezier(0.4, 0, 0.6, 1) infinite;
}

@keyframes pulse {
    0%, 100% {
        opacity: 1;
    }
    50% {
        opacity: .5;
    }
}

.sticky {
    position: sticky;
    top: 1.5rem;
}
</style>

@endsection
