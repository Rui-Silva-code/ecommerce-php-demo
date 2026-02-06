<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: paginaadmin.php');
    exit;
}

require_once 'config/basedados.php';

$produtoID = (int)($_POST['produtoID'] ?? 0);
$preco = (float)($_POST['preco'] ?? 0);
$quantidade = (int)($_POST['quantidade'] ?? 0);

if ($produtoID <= 0) {
    echo "<script>alert('Produto inválido'); window.history.back();</script>";
    exit;
}

$stmt = $pdo->prepare(
    "UPDATE produtos SET preco = ?, quantidade = ? WHERE produtoID = ?"
);

$stmt->execute([$preco, $quantidade, $produtoID]);

if ($stmt->rowCount() > 0) {
    echo "<script>alert('Produto atualizado'); window.history.back();</script>";
} else {
    echo "<script>alert('Produto não encontrado'); window.history.back();</script>";
}
