<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Livros</title>
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
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
            opacity: 0;
            animation: fadeIn 0.5s ease-in forwards;
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        @keyframes slideUp {
            from { 
                transform: translateY(20px);
                opacity: 0;
            }
            to { 
                transform: translateY(0);
                opacity: 1;
            }
        }

        .container {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            padding: 40px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 800px;
            transform: translateY(20px);
            animation: slideUp 0.5s ease-out forwards;
        }

        .container.fade-out {
            animation: fadeOut 0.5s ease-out forwards;
        }

        @keyframes fadeOut {
            from { opacity: 1; }
            to { opacity: 0; }
        }

        h1 {
            font-size: 2.5rem;
            color: #1e293b;
            margin-bottom: 40px;
            text-align: center;
            font-weight: 700;
        }

        .form-group {
            margin-bottom: 25px;
            position: relative;
            opacity: 0;
            animation: fadeIn 0.5s ease-out forwards 0.3s;
        }

        label {
            display: block;
            margin-bottom: 8px;
            color: #4a5568;
            font-weight: 600;
            font-size: 1rem;
        }

        input[type="text"],
        input[type="date"] {
            width: 100%;
            padding: 12px 16px;
            border: 2px solid #e2e8f0;
            border-radius: 10px;
            font-size: 1rem;
            transition: all 0.3s ease;
            background: white;
        }

        input[type="text"]:focus,
        input[type="date"]:focus {
            outline: none;
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
        }

        .search-group {
            display: flex;
            gap: 10px;
            margin-bottom: 25px;
            opacity: 0;
            animation: fadeIn 0.5s ease-out forwards 0.2s;
        }

        .search-group input {
            flex: 1;
        }

        button {
            padding: 12px 24px;
            border: none;
            border-radius: 50px;
            background: linear-gradient(45deg, #3b82f6, #8b5cf6);
            color: white;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            font-size: 1rem;
            margin: 5px;
        }

        button:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(59, 130, 246, 0.3);
        }

        button:active {
            transform: translateY(0);
        }

        .action-buttons {
            display: flex;
            justify-content: center;
            gap: 15px;
            margin-top: 30px;
            flex-wrap: wrap;
            opacity: 0;
            animation: fadeIn 0.5s ease-out forwards 0.4s;
        }

        .exit-button {
            background: linear-gradient(45deg, #ef4444, #dc2626);
        }

        .exit-button:hover {
            box-shadow: 0 4px 12px rgba(239, 68, 68, 0.3);
        }

        #mensagem {
            margin-top: 20px;
            padding: 15px;
            border-radius: 10px;
            text-align: center;
            font-weight: 500;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        #mensagem.visible {
            opacity: 1;
        }
    </style>
    <script>
        function enviarFormulario(botao) {
            const formData = new FormData();
            formData.append('id', document.getElementById("id").value);
            formData.append('nome', document.getElementById("nome").value);
            formData.append('categoria', document.getElementById("categoria").value);
            formData.append('lancamento', document.getElementById("lancamento").value);
            formData.append('botao', botao);

            fetch('livros_modify.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                const mensagemEl = document.getElementById("mensagem");
                mensagemEl.innerHTML = data.mensagem;
                mensagemEl.style.backgroundColor = data.sucesso ? '#dcfce7' : '#fee2e2';
                mensagemEl.style.color = data.sucesso ? '#166534' : '#991b1b';
                mensagemEl.classList.add('visible');

                if (data.sucesso && botao === 'consulta') {
                    document.getElementById("nome").value = data.nome || '';
                    document.getElementById("categoria").value = data.categoria || '';
                    document.getElementById("lancamento").value = data.lancamento || '';
                }
            })
            .catch(error => {
                const mensagemEl = document.getElementById("mensagem");
                mensagemEl.innerHTML = "Erro ao processar a requisição.";
                mensagemEl.style.backgroundColor = '#fee2e2';
                mensagemEl.style.color = '#991b1b';
                mensagemEl.classList.add('visible');
                console.error('Erro:', error);
            });
        }

        function limparFormulario() {
            document.getElementById("id").value = '';
            document.getElementById("nome").value = '';
            document.getElementById("categoria").value = '';
            document.getElementById("lancamento").value = '';
            document.getElementById("mensagem").innerHTML = '';
            document.getElementById("mensagem").classList.remove('visible');
        }

        function sair() {
            document.querySelector('.container').classList.add('fade-out');
            setTimeout(() => {
                window.location.href = "principal.php";
            }, 500);
        }
    </script>
</head>
<body>
    <div class="container">
        <h1>Cadastro de Livros</h1>

        <div class="search-group">
            <input type="text" id="id" placeholder="Digite o código do livro">
            <button onclick="enviarFormulario('consulta')">Buscar</button>
        </div>

        <div class="form-group">
            <label>Nome do livro:</label>
            <input type="text" id="nome" placeholder="Digite o nome do livro">
        </div>
        <div class="form-group">
            <label>Categoria:</label>
            <input type="text" id="categoria" placeholder="Digite a categoria">
        </div>
        <div class="form-group">
            <label>Lançamento:</label>
            <input type="text" id="lancamento" placeholder="Digite a data de lançamento">
        </div>

        <div class="action-buttons">
            <button onclick="enviarFormulario('inserir')">Inserir</button>
            <button onclick="enviarFormulario('alterar')">Alterar</button>
            <button onclick="enviarFormulario('excluir')">Excluir</button>
            <button onclick="limparFormulario()">Limpar</button>
            <button onclick="sair()" class="exit-button">Sair</button>
        </div>

        <p id="mensagem"></p>
    </div>
</body>
</html>