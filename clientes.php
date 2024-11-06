<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Clientes</title>
    <style>
       
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Arial', sans-serif; 
            background-color: #f4f6f9; 
            color: #333; display: flex; 
            justify-content: center; 
            align-items: center; 
            height: 100vh; opacity: 0; 
            animation: fadeIn 0.5s forwards; 
        }
        .container { background-color: #fff; 
            border-radius: 10px; 
            box-shadow: 0px 10px 30px rgba(0, 0, 0, 0.1); 
            max-width: 500px; 
            width: 100%; 
            padding: 40px; 
            text-align: center; 
        }
        h1 { font-size: 36px; 
            font-weight: bold; 
            color: #333; 
            margin-bottom: 30px; 
        }
        label { font-size: 18px; 
            color: #666; 
            display: block; 
            margin-top: 10px; 
        }
        input[type="text"] { width: 100%; 
            padding: 10px; 
            margin-top: 5px; 
            border: 1px solid #ccc; 
            border-radius: 5px; 
            font-size: 16px; 
        }
        button { font-size: 16px; 
            padding: 10px 20px; 
            margin-top: 20px; 
            background: linear-gradient(45deg, #007bff, #8a2be2); 
            color: white; 
            border: none; 
            border-radius: 20px; 
            cursor: pointer; 
            transition: transform 0.3s ease, background-color 0.3s ease; 
        }
        button:hover { background: linear-gradient(45deg, #0056b3, #6a0dad); 
            transform: scale(1.1); 
        }
        #mensagem { margin-top: 20px; 
            font-size: 16px; color: #333; 
        }
        a button { background: #dc3545; 
        }
        a button:hover { background: #a92333; 
        }
        @keyframes fadeIn { to { opacity: 1; } 
        }
    </style>
    <script>
        function enviarFormulario(botao) {
            const formData = new FormData();
            formData.append('id', document.getElementById("id").value);
            formData.append('nome', document.getElementById("nome").value);
            formData.append('cpf', document.getElementById("cpf").value);
            formData.append('botao', botao);

            fetch('clientes_modify.php', {
                method: 'POST',
                body: formData
            })
            .then(response => {
                if (!response.ok) throw new Error('Erro na requisição');
                return response.json();
            })
            .then(data => {
                document.getElementById("mensagem").innerText = data.mensagem;

                if (botao === 'consulta' && data.sucesso) {
                    document.getElementById("nome").value = data.cli_nome;
                    document.getElementById("cpf").value = data.cli_cpf;
                }
            })
            .catch(error => {
                console.error('Erro:', error);
                document.getElementById("mensagem").innerText = "Erro ao realizar a operação.";
            });
        }
    </script>
</head>
<body>
<section class="container">
    <h1>Cadastro de Clientes</h1>
    <div>
        <label>Código:</label>
        <input type="text" id="id">
        <button onclick="enviarFormulario('consulta')">Buscar</button><br><br>

        <label>Nome:</label>
        <input type="text" id="nome"><br><br>

        <label>CPF:</label>
        <input type="text" id="cpf"><br><br>
    </div>
    
    <button onclick="enviarFormulario('inserir')">Inserir</button>
    <button onclick="enviarFormulario('alterar')">Alterar</button>
    <button onclick="enviarFormulario('excluir')">Excluir</button><br><br>
    <p id="mensagem"></p>
    <a href="principal.php"><button>Sair</button></a>
</section>
</body>
</html>
