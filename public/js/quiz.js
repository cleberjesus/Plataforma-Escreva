document.addEventListener('DOMContentLoaded', () => {

    const questions = [
        {
            question: "Qual frase utiliza a crase corretamente?",
            answers: [
                { text: "Obrigado a todos pela presença.", correct: false },
                { text: "Fui à farmácia comprar remédios.", correct: true },
                { text: "Ele chegou a tempo para a reunião.", correct: false },
                { text: "Ela começou a rir sem parar.", correct: false }
            ]
        },
        {
            question: "Indique a alternativa em que o uso do acento grave indicativo da crase é obrigatório.",
            answers: [
                { text: "O navio chegou a Bahia.", correct: false },
                { text: "Dirigiu-se a ela com respeito.", correct: false },
                { text: "Ele prefere morrer a ter que trabalhar.", correct: false },
                { text: "Devo tudo à minha mãe.", correct: true }
            ]
        },
        {
            question: "Em qual das opções a crase foi empregada de forma incorreta?",
            answers: [
                { text: "Referiu-se àquilo que não conhecia.", correct: false },
                { text: "Às vezes, penso em desistir de tudo.", correct: false },
                { text: "Não vou à festas que não sou convidado.", correct: true },
                { text: "Entreguei o prêmio à melhor aluna.", correct: false }
            ]
        },
        {
            question: "Qual frase NÃO deve ter crase?",
            answers: [
                { text: "O texto faz referência a uma antiga lenda.", correct: true },
                { text: "A peça teatral começará às 20h.", correct: false },
                { text: "Sempre vamos à praia no verão.", correct: false },
                { text: "Ele se dedica à arte com paixão.", correct: false }
            ]
        },
        {
            question: "Assinale a frase em que 'a' ou 'as' deve receber o acento da crase:",
            answers: [
                { text: "Voltei a casa dos meus pais.", correct: false },
                { text: "Puseram-se a discutir em voz alta.", correct: false },
                { text: "O menino não deu importância a pequena sugestão.", correct: true },
                { text: "A empresa oferece boas condições de trabalho a suas funcionárias.", correct: false }
            ]
        },
        {
            question: "Assinale a frase em que há uso correto da vírgula:",
            answers: [
                { text: "Maria foi na escola e, depois foi ao mercado.", correct: false },
                { text: "O professor explicou o conteúdo mas, ninguém entendeu.", correct: false },
                { text: "João chegou cedo, porém foi embora antes do término da aula.", correct: false },
                { text: "Os alunos que estudam bastante, geralmente, conseguem boas notas.", correct: true }
            ]
        },
        {
            question: "Em qual alternativa o termo destacado é uma conjunção conclusiva?",
            answers: [
                { text: "Gostaria que você viesse, porém entendo se não puder.", correct: false },
                { text: "Se chover, não sairemos.", correct: false },
                { text: "Assim que cheguei, liguei para ela.", correct: false },
                { text: "Estudou bastante, portanto, passou na prova.", correct: true }
            ]
        },
        {
            question: "Qual das alternativas apresenta um erro de regência verbal?",
            answers: [
                { text: "Prefiro estudar em casa.", correct: false },
                { text: "Gostaria de agradecer aos professores.", correct: false },
                { text: "Obedecemos às regras da escola.", correct: false },
                { text: "Assisti o filme ontem.", correct: true }
            ]
        },
        {
            question: "Qual é a estrutura básica de uma redação dissertativa-argumentativa exigida no ENEM?",
            answers: [
                { text: "Conclusão, Introdução e Desenvolvimento.", correct: false },
                { text: "Resumo, Introdução e Desenvolvimento.", correct: false },
                { text: "Introdução, Desenvolvimento e Conclusão.", correct: true },
                { text: "Desenvolvimento, Introdução e Referências.", correct: false }
            ]
        },
        {
            question: "Identifique a alternativa em que há um problema de concordância verbal:",
            answers: [
                { text: "Faltam informações importantes no texto.", correct: false },
                { text: "Restam poucas dúvidas sobre o tema.", correct: false },
                { text: "Existem várias formas de começar um texto.", correct: false },
                { text: "Houveram muitos problemas na redação.", correct: true }
            ]
        },
        {
            question: "Sobre o uso da crase, marque a alternativa correta:",
            answers: [
                { text: "Ele foi a escola com os amigos.", correct: false },
                { text: "Voltou a casa cansado.", correct: false },
                { text: "Entreguei o trabalho à professora.", correct: true },
                { text: "Cheguei à noite e fui dormir cedo.", correct: true }
            ]
        }
    ];
    

    const questionTextElement = document.getElementById('question-text');
    const answerButtonsElement = document.getElementById('answer-buttons');
    const nextButton = document.getElementById('next-btn');
    const feedbackElement = document.getElementById('feedback-text');
    const resultsContainer = document.getElementById('results-container');
    const scoreTextElement = document.getElementById('score-text');
    const restartButton = document.getElementById('restart-btn');
    const quizCard = document.querySelector('.quiz-card');

    let currentQuestionIndex = 0;
    let score = 0;

    // Função para embaralhar um array (Fisher-Yates)
    function shuffleArray(array) {
        for (let i = array.length - 1; i > 0; i--) {
            const j = Math.floor(Math.random() * (i + 1));
            [array[i], array[j]] = [array[j], array[i]];
        }
    }

    function startQuiz() {
        currentQuestionIndex = 0;
        score = 0;
        resultsContainer.style.display = 'none';
        nextButton.style.display = 'none';
        quizCard.querySelector('.quiz-header').style.display = '';
        quizCard.querySelector('.quiz-body').style.display = 'grid';
        quizCard.querySelector('.quiz-footer').style.display = 'flex';
        showQuestion();
    }

    function showQuestion() {
        resetState();
        let currentQuestion = questions[currentQuestionIndex];
        // Embaralha as alternativas antes de mostrar
        shuffleArray(currentQuestion.answers);
        questionTextElement.innerText = currentQuestion.question;

        currentQuestion.answers.forEach(answer => {
            const button = document.createElement('button');
            button.innerText = answer.text;
            button.classList.add('answer-btn');
            if (answer.correct) {
                button.dataset.correct = answer.correct;
            }
            button.addEventListener('click', selectAnswer);
            answerButtonsElement.appendChild(button);
        });
    }

    function resetState() {
        nextButton.style.display = 'none';
        feedbackElement.innerText = '';
        feedbackElement.className = 'feedback';
        while (answerButtonsElement.firstChild) {
            answerButtonsElement.removeChild(answerButtonsElement.firstChild);
        }
    }

    function selectAnswer(e) {
        const selectedBtn = e.target;
        const isCorrect = selectedBtn.dataset.correct === 'true';

        if (isCorrect) {
            score++;
            feedbackElement.innerText = 'Resposta Correta!';
            feedbackElement.classList.add('correct');
        } else {
            feedbackElement.innerText = 'Resposta Incorreta.';
            feedbackElement.classList.add('incorrect');
        }

        Array.from(answerButtonsElement.children).forEach(button => {
            setStatusClass(button, button.dataset.correct === 'true');
            button.disabled = true;
        });

        if (questions.length > currentQuestionIndex + 1) {
            nextButton.style.display = 'block';
        } else {
            showResults();
        }
    }

    function setStatusClass(element, correct) {
        if (correct) {
            element.classList.add('correct');
        } else {
            element.classList.add('incorrect');
        }
    }

    function showNextQuestion() {
        currentQuestionIndex++;
        showQuestion();
    }

    function showResults() {
        resetState();
        quizCard.querySelector('.quiz-header').style.display = 'none';
        quizCard.querySelector('.quiz-body').style.display = 'none';
        quizCard.querySelector('.quiz-footer').style.display = 'none';

        resultsContainer.style.display = 'block';
        scoreTextElement.innerText = `Você acertou ${score} de ${questions.length} perguntas!`;
    }

    nextButton.addEventListener('click', showNextQuestion);
    restartButton.addEventListener('click', startQuiz);

    startQuiz();
}); 