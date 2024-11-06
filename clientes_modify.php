<?php
header('Content-Type: application/json');
include 'conecta.php';

$id = $_POST['id'] ?? '';
$nome = $_POST['nome'] ?? '';
$cpf = $_POST['cpf'] ?? '';
$botao = $_POST['botao'] ?? '';

$response = ['sucesso' => false, 'mensagem' => ''];

try {
    if ($botao === 'inserir') {
        $sql = "INSERT INTO clientes (cli_nome, cli_cpf) VALUES (?, ?)";
        $stmt = $conn->prepare($sql);

        if ($stmt === false) {
            throw new Exception("Erro na preparação da consulta: " . $conn->error);
        }

        $stmt->bind_param("ss", $nome, $cpf);
        if ($stmt->execute()) {
            $response = ['sucesso' => true, 'mensagem' => 'Cliente inserido com sucesso.'];
        } else {
            throw new Exception('Erro ao inserir cliente: ' . $stmt->error);
        }

    } elseif ($botao === 'alterar') {
        $sql = "UPDATE clientes SET cli_nome = ?, cli_cpf = ? WHERE cli_codigo = ?";
        $stmt = $conn->prepare($sql);

        if ($stmt === false) {
            throw new Exception("Erro na preparação da consulta: " . $conn->error);
        }

        $stmt->bind_param("ssi", $nome, $cpf, $id);
        if ($stmt->execute()) {
            $response = ['sucesso' => true, 'mensagem' => 'Cliente alterado com sucesso.'];
        } else {
            throw new Exception('Erro ao alterar cliente: ' . $stmt->error);
        }

    } elseif ($botao === 'excluir') {
        $sql = "DELETE FROM clientes WHERE id = ?";
        $stmt = $conn->prepare($sql);

        if ($stmt === false) {
            throw new Exception("Erro na preparação da consulta: " . $conn->error);
        }

        $stmt->bind_param("i", $id);
        if ($stmt->execute()) {
            $response = ['sucesso' => true, 'mensagem' => 'Cliente excluído com sucesso.'];
        } else {
            throw new Exception('Erro ao excluir cliente: ' . $stmt->error);
        }

    } elseif ($botao === 'consulta') {
        $sql = "SELECT cli_nome, cli_cpf FROM clientes WHERE cli_codigo = ?";
        $stmt = $conn->prepare($sql);

        if ($stmt === false) {
            throw new Exception("Erro na preparação da consulta: " . $conn->error);
        }

        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $response = [
                'sucesso' => true,
                'cli_nome' => $row['nome'],
                'cli_cpf' => $row['cpf'],
                'mensagem' => 'Cliente encontrado.'
            ];
        } else {
            $response = ['sucesso' => false, 'mensagem' => 'Cliente não encontrado.'];
        }
    } else {
        throw new Exception('Operação inválida.');
    }
} catch (Exception $e) {
    $response = ['sucesso' => false, 'mensagem' => 'Erro: ' . $e->getMessage()];
}

echo json_encode($response);
$conn->close();
?>
