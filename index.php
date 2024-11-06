<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservas de Livros Online</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f6f9;
            color: #333;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            display: flex;
            background-color: #fff;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0px 10px 30px rgba(0, 0, 0, 0.1);
            max-width: 1500px; 
            width: 100%;
            min-height: 900px; 
        }

        .text-section {
            padding: 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            width: 50%;
            text-align: left;
        }

        .text-section h1 {
            font-size: 120px;
            font-weight: bold;
            font-family: Copperplate;
            color: #000;
            line-height: 1.2; 
            margin-bottom: 20px;
        }

        .text-section p {
            font-size: 18px;
            color: #666;
            margin-bottom: 30px;
        }

        .text-section a {
            align-self: center;
            width: 110px;
            display: inline-block;
            font-size: 20px;
            text-decoration: none;
            background: linear-gradient(45deg, #007bff, #8a2be2);
            color: white;
            padding: 10px 20px;
            border-radius: 20px;
            transition: transform 0.3s ease, background-color 0.3s ease;
            cursor: pointer;
        }

        .text-section a:hover {
            background: linear-gradient(45deg, #0056b3, #6a0dad);
            transform: scale(1.1) translateY(-5px);
        }

        .image-section {
            width: 50%;
            background-image: url('foto.jpg');
            background-size: cover;
            background-position: center;
            animation: moveImage 20s ease-in-out infinite alternate;
        }

        @keyframes moveImage {
            0% { transform: translateX(0); }
            50% { transform: translateX(10px); }
            100% { transform: translateX(-10px); }
        }

        /* Animação de fade-out para a transição */
        @keyframes fadeOut {
            from { opacity: 1; }
            to { opacity: 0; }
        }

        .fade-out {
            animation: fadeOut 0.5s forwards;
        }
    </style>
    <script>
        function acessarPagina() {
            // Adiciona classe de fade-out ao container
            document.querySelector('.container').classList.add('fade-out');
            
            // Aguarda a animação terminar antes de redirecionar
            setTimeout(() => {
                window.location.href = "principal.php";
            }, 500);
        }

        // Previne que o usuário veja a animação ao voltar usando o botão do navegador
        window.addEventListener('pageshow', function(event) {
            if (event.persisted) {
                document.querySelector('.container').classList.remove('fade-out');
            }
        });
    </script>
</head>
<body>
    <div class="container">
        <div class="text-section">
            <h1>Reservas <br> de <br> Livros <br> Online</h1>
            <p>Gerencie suas reservas de livros de forma prática e rápida!</p>
            <a onclick="acessarPagina()">Acessar</a>
        </div>
        <div class="image-section"></div>
    </div>
</body>
</html>