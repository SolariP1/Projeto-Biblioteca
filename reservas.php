<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Reservas</title>
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
            animation: fadeIn 0.5s ease-out forwards;
        }

        label {
            display: block;
            margin-bottom: 8px;
            color: #4a5568;
            font-weight: 600;
            font-size: 1rem;
        }

        input[type="text"],
        input[type="date"],
        select {
            width: 100%;
            padding: 12px 16px;
            border: 2px solid #e2e8f0;
            border-radius: 10px;
            font-size: 1rem;
            transition: all 0.3s ease;
            background-color: white;
        }

        input[type="text"]:focus,
        input[type="date"]:focus,
        select:focus {
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
            outline: none;
        }

        .search-group {
            display: flex;
            gap: 10px;
            margin-bottom: 25px;
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
            box-shadow: 0 6px 12px rgba(59, 130, 246, 0.2);
            background: linear-gradient(45deg, #2563eb, #7c3aed);
        }

        .action-buttons {
            display: flex;
            justify-content: center;
            gap: 15px;
            margin-top: 30px;
            flex-wrap: wrap;
        }

        #mensagem {
            margin-top: 20px;
            padding: 15px;
            border-radius: 10px;
            text-align: center;
            font-weight: 500;
            opacity: 0;
            animation: fadeIn 0.3s ease-out forwards;
        }

        .exit-button {
            background: linear-gradient(45deg, #ef4444, #dc2626);
            margin-top: 20px;
        }

        .exit-button:hover {
            background: linear-gradient(45deg, #dc2626, #b91c1c);
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

        @keyframes fadeOut {
            from { opacity: 1; }
            to { opacity: 0; }
        }

        .fade-out {
            animation: fadeOut 0.5s forwards;
        }

        /* Animação para os elementos do formulário */
        .form-group:nth-child(1) { animation-delay: 0.1s; }
        .form-group:nth-child(2) { animation-delay: 0.2s; }
        .form-group:nth-child(3) { animation-delay: 0.3s; }
        .form-group:nth-child(4) { animation-delay: 0.4s; }
        .form-group:nth-child(5) { animation-delay: 0.5s; }
    </style>
    <script>
        function enviarFormulario(botao) {
            const formData = new FormData();
            formData.append('id', document.getElementById("id").value);
            formData.append('reserva', document.getElementById("reserva").value);
            formData.append('devolucao', document.getElementById("devolucao").value);
            formData.append('liv_codigo', document.getElementById("liv_codigo").value); 
            formData.append('cli_codigo', document.getElementById("cli_codigo").value); 
            formData.append('botao', botao);

            fetch('reservas_modify.php', { method: 'POST', body: formData })
                .then(response => response.json())
                .then(data => {
                    const mensagemEl = document.getElementById("mensagem");
                    mensagemEl.innerHTML = data.mensagem;
                    mensagemEl.style.backgroundColor = data.sucesso ? '#dcfce7' : '#fee2e2';
                    mensagemEl.style.color = data.sucesso ? '#166534' : '#991b1b';

                    if (botao === 'consulta' && data.sucesso) {
                        document.getElementById("reserva").value = data.res_reserva;
                        document.getElementById("devolucao").value = data.res_devolucao;
                        document.getElementById("liv_codigo").value = data.liv_codigo; 
                        document.getElementById("cli_codigo").value = data.cli_codigo; 
                    }
                })
                .catch(error => {
                    console.error('Erro:', error);
                    const mensagemEl = document.getElementById("mensagem");
                    mensagemEl.innerHTML = "Erro ao realizar a operação.";
                    mensagemEl.style.backgroundColor = '#fee2e2';
                    mensagemEl.style.color = '#991b1b';
                });
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
        <h1>Sistema de Reservas</h1>
        
        <div class="search-group">
            <input type="text" id="id" placeholder="Digite o código da reserva">
            <button onclick="enviarFormulario('consulta')">Buscar</button>
        </div>
        
        <div class="form-group">
            <label>Data inicial:</label>  
            <input type="date" id="reserva">
        </div>
        
        <div class="form-group">
            <label>Data final:</label>
            <input type="date" id="devolucao">
        </div>

        <div class="form-group">
            <label>Livro:</label>
            <select id="liv_codigo">
                <option value="">Selecione um Livro</option>
                <?php
                include 'conecta.php';
                $sql = "SELECT liv_codigo, liv_nome FROM livros";
                $result = mysqli_query($conn, $sql);
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<option value='{$row['liv_codigo']}'>{$row['liv_nome']}</option>";
                }
                ?>
            </select>
        </div>

        <div class="form-group">
            <label>Cliente:</label>
            <select id="cli_codigo">
                <option value="">Selecione um Cliente</option>
                <?php
                $sql = "SELECT cli_codigo, cli_nome FROM clientes"; 
                $result = mysqli_query($conn, $sql);
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<option value='{$row['cli_codigo']}'>{$row['cli_nome']}</option>";
                }
                mysqli_close($conn);
                ?>
            </select>
        </div>

        <div class="action-buttons">
            <button onclick="enviarFormulario('inserir')">Inserir</button>
            <button onclick="enviarFormulario('alterar')">Alterar</button>
            <button onclick="enviarFormulario('excluir')">Excluir</button>
            <button onclick="sair()" class="exit-button">Sair</button>
        </div>
        
        <p id="mensagem"></p>
    </div>
</body>
</html>