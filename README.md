# Plataforma Escreva

**Objetivo:**  
Ajudar estudantes que estão se preparando para vestibulares a praticar e melhorar suas redações por meio de simulados, correções com inteligência artificial e um sistema de armazenamento acessível e eficiente.

---

## ✨ Funcionalidades

### 🃏 Simulado Coringa  
- Geração aleatória de temas de redação para estimular a criatividade e preparo em diferentes áreas.
- Sistema de níveis (Iniciante, Intermediário, Avançado) com tempos personalizados.

### �� Simulado Comum  
- Temas de redação baseados em vestibulares anteriores e temas atuais recorrentes com tempo ilimitado.

### �� Correção com IA  
- Correção automatizada de redações com base nos critérios do ENEM.  
- Exibição de nota por competência (de 0 a 200 pontos por critério, totalizando até 1000).  
- Suporte a redações digitadas diretamente na plataforma ou enviadas como imagem.

### 🗂️ Armazenamento de Redações  
- Salvamento e organização de redações escritas ou escaneadas.  
- Histórico de desempenho disponível para consulta futura.

### 📊 Análise de Desempenho
- Gráficos interativos mostrando progresso ao longo do tempo.
- Estatísticas detalhadas por mês e competência.


### 💳 Sistema Premium
- Assinatura premium com funcionalidades exclusivas via Stripe.

---

## 🔧 Tecnologias Utilizadas

- **Laravel 12.x** – Framework backend PHP
- **PHP 8.2+** – Linguagem de programação
- **MySQL** – Banco de dados relacional
- **Tailwind CSS** – Framework CSS
- **Alpine.js** – Framework JavaScript
- **Stripe** – Processamento de pagamentos
- **Chart.js** – Gráficos interativos

---

## 🚀 Instalação

### Pré-requisitos
- PHP 8.2+
- Composer
- Node.js
- MySQL

### Passos

1. **Clone o repositório**
   ```bash
   git clone https://github.com/seu-usuario/plataforma-escreva.git
   cd plataforma-escreva
   ```

2. **Instale as dependências**
   ```bash
   composer install
   npm install
   ```

3. **Configure o ambiente**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. **Configure o banco de dados no .env**
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=plataforma_escreva
   DB_USERNAME=seu_usuario
   DB_PASSWORD=sua_senha
   ```

5. **Execute as migrações**
   ```bash
   php artisan migrate
   php artisan storage:link
   ```

6. **Compile os assets**
   ```bash
   npm run build
   ```

7. **Inicie o servidor**
   ```bash
   php artisan serve
   ```


