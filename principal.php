<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Biblioteca - Página Principal</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Arial', sans-serif;
            background: linear-gradient(135deg, #f6f8fb 0%, #e9f0f7 100%);
            min-height: 100vh;
            position: relative;
            overflow-x: hidden;
            opacity: 0; /* Inicialmente invisível */
            animation: fadeIn 1s forwards; /* Animação de fade-in */
        }

        .top-nav {
            display: flex; /* Permite alinhar os botões */
            justify-content: space-between; /* Distribui os botões nos cantos */
            align-items: center; /* Alinha verticalmente */
            position: fixed;
            top: 0;
            left: 0; /* Esquerda em vez de direita */
            width: 100%; /* Ocupa toda a largura */
            padding: 20px;
            z-index: 100;
            background: rgba(255, 255, 255, 0.8); /* Fundo semi-transparente */
            backdrop-filter: blur(5px); /* Efeito blur */
        }

        .nav-button {
            background: linear-gradient(45deg, #2563eb, #4f46e5);
            color: white;
            padding: 12px 24px;
            border-radius: 50px;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .back-button { /* Novo estilo para o botão "Voltar" */
            background: #d1d5db; /* Cinza claro */
            color: #1f2937; /* Cinza escuro */
            padding: 10px 20px;
            border-radius: 50px;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .back-button:hover {
            background: #9ca3af; /* Cinza médio */
            transform: translateY(-2px);
        }

        .nav-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 8px rgba(0, 0, 0, 0.2);
            background: linear-gradient(45deg, #1d4ed8, #4338ca);
        }

        .main-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            padding: 20px;
            text-align: center;
        }

        .content-box {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            padding: 40px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            max-width: 800px;
            width: 90%;
            margin: 20px;
        }

        h1 {
            font-size: 2.5rem;
            color: #1e293b;
            margin-bottom: 20px;
            font-weight: 700;
        }

        .image-container {
            margin: 30px 0;
            position: relative;
            animation: float 10s ease-in-out infinite;
        }

        .main-image {
            max-width: 700px;
            width: 100%;
            height: auto;
            border-radius: 10px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }

        .action-button {
            background: linear-gradient(45deg, #3b82f6, #8b5cf6);
            color: white;
            padding: 15px 30px;
            border-radius: 50px;
            text-decoration: none;
            font-weight: 600;
            display: inline-block;
            margin-top: 20px;
            transition: all 0.3s ease;
            border: none;
            cursor: pointer;
            font-size: 1.1rem;
        }

        .action-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 8px rgba(0, 0, 0, 0.2);
            background: linear-gradient(45deg, #2563eb, #7c3aed);
        }

        .welcome-text {
            color: #475569;
            font-size: 1.2rem;
            line-height: 1.6;
            margin-bottom: 30px;
        }

        /* Animação de flutuação */
        @keyframes float {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
            100% { transform: translateY(0px); }
        }

        /* Animação de fade-in e fade-out */
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        @keyframes fadeOut {
            from { opacity: 1; }
            to { opacity: 0; }
        }
    </style>
    <script>
        // Fade-out antes de redirecionar
        function fadeOutAndRedirect(url) {
            document.body.style.animation = "fadeOut 1s forwards"; // Aplica fade-out
            setTimeout(() => {
                window.location.href = url; // Redireciona após 1s
            }, 1000);
        }
    </script>
</head>
<body>
    <nav class="top-nav">
        <a href="javascript:void(0)" onclick="fadeOutAndRedirect('index.php')" class="back-button">Voltar</a> 
        <a href="javascript:void(0)" onclick="fadeOutAndRedirect('clientes.php')" class="nav-button">Área de Clientes</a>
        <a href="javascript:void(0)" onclick="fadeOutAndRedirect('livros.php')" class="nav-button">Livros</a> </nav>

    <main class="main-container">
        <div class="content-box">
            <h1>Biblioteca Digital</h1>
            <p class="welcome-text">
                Bem-vindo ao nosso sistema de gerenciamento de biblioteca. 
                Aqui você pode explorar nosso acervo, fazer reservas e gerenciar empréstimos.
            </p>

            <div class="image-container">
                <img src="../biblioteca/principal.jpg" alt="Biblioteca" class="main-image">
            </div>

            <a href="javascript:void(0)" onclick="fadeOutAndRedirect('reservas.php')" class="action-button">
                Acessar Sistema de Reservas
            </a>
        </div>
    </main>
</body>
</html>
