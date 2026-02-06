<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: paginaadmin.php');
    exit;
}

require_once 'config/basedados.php';

$nome = trim($_POST['nome'] ?? '');
$quantidade = (int)($_POST['quantidade'] ?? 0);
$preco = (float)($_POST['preco'] ?? 0);

if ($nome === '' || $quantidade <= 0 || $preco <= 0) {
    echo "<script>alert('Dados inválidos'); window.history.back();</script>";
    exit;
}

$stmt = $pdo->prepare(
    "INSERT INTO produtos (nome, quantidade, preco) VALUES (?, ?, ?)"
);

$stmt->execute([$nome, $quantidade, $preco]);

echo "<script>alert('Produto inserido com sucesso'); window.history.back();</script>";
