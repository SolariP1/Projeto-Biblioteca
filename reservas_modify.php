<?php
include 'conecta.php';

$id = $_POST['id'] ?? null;
$reserva = $_POST['reserva'] ?? null;
$devolucao = $_POST['devolucao'] ?? null;
$liv_codigo = $_POST['liv_codigo'] ?? null; 
$cli_codigo = $_POST['cli_codigo'] ?? null; 
$botao = $_POST['botao'] ?? null;

$response = ["sucesso" => false, "mensagem" => ""];

switch ($botao) {
    case 'consulta':
        if ($id) {
            $sql = "SELECT * FROM reservas WHERE res_codigo = '$id'";
            $result = mysqli_query($conn, $sql);

            if ($result && mysqli_num_rows($result) > 0) {
                $row = mysqli_fetch_assoc($result);
                $response = [
                    "sucesso" => true,
                    "res_reserva" => $row['res_reserva'],
                    "res_devolucao" => $row['res_devolucao'],
                    "liv_codigo" => $row['liv_codigo'],
                    "cli_codigo" => $row['cli_codigo'], 
                    "mensagem" => "Cliente encontrado."
                ];
            } else {
                $response["mensagem"] = "Cliente não encontrado.";
            }
        } else {
            $response["mensagem"] = "Código do cliente não informado.";
        }
        break;

    case 'inserir':
        if ($reserva && $devolucao) {
            $sql = "INSERT INTO reservas (res_reserva, res_devolucao, liv_codigo, cli_codigo) VALUES ('$reserva', '$devolucao', '$liv_codigo', '$cli_codigo')";
            $response["mensagem"] = mysqli_query($conn, $sql) ? "Gravado com sucesso!" : "Erro ao gravar: " . mysqli_error($conn);
            $response["sucesso"] = true;
        } else {
            $response["mensagem"] = "Preencha todos os campos!";
        }
        break;

    case 'alterar':
        if ($id && $reserva && $devolucao) {
            $sql = "UPDATE reservas SET res_reserva = '$reserva', res_devolucao = '$devolucao', liv_codigo = '$liv_codigo', cli_codigo = '$cli_codigo' WHERE res_codigo = '$id'";
            $response["mensagem"] = mysqli_query($conn, $sql) ? "Atualizado com sucesso!" : "Erro ao atualizar: " . mysqli_error($conn);
            $response["sucesso"] = true;
        } else {
            $response["mensagem"] = "Preencha todos os campos!";
        }
        break;

    case 'excluir':
        if ($id) {
            $sql = "DELETE FROM reservas WHERE res_codigo = '$id'";
            $response["mensagem"] = mysqli_query($conn, $sql) ? "Excluído com sucesso!" : "Erro ao excluir: " . mysqli_error($conn);
            $response["sucesso"] = true;
        } else {
            $response["mensagem"] = "Código do cliente não informado.";
        }
        break;

    default:
        $response["mensagem"] = "Ação inválida.";
}

mysqli_close($conn);
echo json_encode($response);
?>
