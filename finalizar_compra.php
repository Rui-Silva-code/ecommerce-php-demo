<?php
session_start();
require_once 'config/basedados.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    die('Método inválido');
}

$nome = trim($_POST['nome'] ?? '');
$data_nascimento = $_POST['data_nascimento'] ?? '';
$morada = trim($_POST['morada'] ?? '');

if ($nome === '' || $data_nascimento === '' || $morada === '') {
    echo "<script>alert('Todos os campos são obrigatórios'); window.history.back();</script>";
    exit;
}

$idade = (new DateTime())->diff(new DateTime($data_nascimento))->y;
if ($idade < 18) {
    echo "<script>alert('É necessário ter 18 anos'); window.history.back();</script>";
    exit;
}

$produtos = $_SESSION['produtos_comprados'] ?? [];
if (empty($produtos)) {
    die('Carrinho vazio');
}

$stmt = $pdo->prepare(
    "INSERT INTO encomendas (nome, data_nascimento, morada, produto, quantidade, preco_total)
     VALUES (?, ?, ?, ?, ?, ?)"
);

foreach ($produtos as $produto) {
    $stmt->execute([
        $nome,
        $data_nascimento,
        $morada,
        $produto['produto'],
        $produto['quantidade'],
        $produto['preco']
    ]);
}

unset($_SESSION['produtos_comprados']);

echo "<script>alert('Compra concluída com sucesso'); window.location.href='paginaprincipal.php';</script>";
