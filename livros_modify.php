<?php
include 'conecta.php';

$id = $_POST['id'] ?? null;
$nome = $_POST['nome'] ?? null;
$categoria = $_POST['categoria'] ?? null; // Corrigido de $valor para $categoria
$lançamento = $_POST['lançamento'] ?? null; // Corrigido para $lançamento
$botao = $_POST['botao'] ?? null; // Corrigido $_POST{'lançamento'} para $_POST['botao']

$response = ["sucesso" => false, "mensagem" => ""];

switch ($botao) {
    case 'consulta':
        if ($id) {
            $sql = "SELECT * FROM livros WHERE liv_codigo = '$id'";
            $result = mysqli_query($conn, $sql);

            if ($result && mysqli_num_rows($result) > 0) {
                $row = mysqli_fetch_assoc($result);
                $response = [
                    "sucesso" => true,
                    "liv_nome" => $row['liv_nome'],
                    "liv_categoria" => $row['liv_categoria'],
                    "liv_lançamento" => $row['liv_lançamento'],
                    "mensagem" => "Livro encontrado"
                ];
            } else {
                $response["mensagem"] = "Livro não encontrado";
            }
        } else {
            $response["mensagem"] = "Código do livro não informado";
        }
        break;
    
    case 'inserir':
        if ($nome && $categoria && $lançamento) {
            $sql = "INSERT INTO livros (liv_nome, liv_categoria, liv_lançamento) VALUES ('$nome', '$categoria', '$lançamento')";
            $response["mensagem"] = mysqli_query($conn, $sql) ? "Gravado com sucesso!" : "Erro ao gravar: " . mysqli_error($conn);
            $response["sucesso"] = true;
        } else {
            $response["mensagem"] = "Preencha todos os campos!";
        }
        break;

    case 'alterar':
        if ($id && $nome && $categoria && $lançamento) {
            $sql = "UPDATE livros SET liv_nome = '$nome', liv_categoria = '$categoria', liv_lançamento = '$lançamento' WHERE liv_codigo = '$id'";
            $response["mensagem"] = mysqli_query($conn, $sql) ? "Atualizado com sucesso!" : "Erro ao atualizar: " . mysqli_error($conn);
            $response["sucesso"] = true;
        } else {
            $response["mensagem"] = "Preencha todos os campos!";
        }
        break;

    case 'excluir':
        if ($id) {
            $sql = "DELETE FROM livros WHERE liv_codigo = '$id'";
            $response["mensagem"] = mysqli_query($conn, $sql) ? "Excluído com sucesso!" : "Erro ao excluir: " . mysqli_error($conn);
            $response["sucesso"] = true;
        } else {
            $response["mensagem"] = "Código do livro não informado";
        }
        break;

    default:
        $response["mensagem"] = "Ação inválida.";
}

mysqli_close($conn);
echo json_encode($response);
?>
