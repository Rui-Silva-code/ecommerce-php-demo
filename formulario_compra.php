<?php
session_start();

$produtosComprados = $_SESSION['produtos_comprados'] ?? [];

if (empty($produtosComprados)) {
    header('Location: paginaprincipal.php');
    exit;
}
?>
<!doctype html>
<html lang="pt">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <title>Loja Online - Rui Silva</title>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

  <style>
    .container-nav { background-color: #eee; padding: 10px; }
    #produtos-comprados { border: 1px solid #ddd; padding: 15px; }
    .produto { text-align: center; margin-bottom: 8px; }
    .formulario { max-width: 600px; margin: auto; }
    .concluirtransicao { float: right; }
  </style>
</head>

<body>

<div class="container mt-5">
    <h2 class="text-center">Resumo da Compra</h2>

    <div id="produtos-comprados" class="mb-4">
        <?php
        $produtos_exibidos = [];
        $valor_total = 0;

        foreach ($produtosComprados as $produto) {
            if (!in_array($produto['produto'], $produtos_exibidos)) {
                $produtos_exibidos[] = $produto['produto'];

                $quantidade_total = 0;
                foreach ($produtosComprados as $p) {
                    if ($p['produto'] === $produto['produto']) {
                        $quantidade_total += (int)$p['quantidade'];
                    }
                }

                $subtotal = $quantidade_total * $produto['preco'];
                $valor_total += $subtotal;
                ?>
                <div class="produto">
                    <strong><?= htmlspecialchars($produto['produto']) ?></strong> —
                    <?= $quantidade_total ?> x
                    <?= number_format($produto['preco'], 2, ',', '.') ?>€
                    = <?= number_format($subtotal, 2, ',', '.') ?>€
                </div>
                <?php
            }
        }
        ?>
        <hr>
        <h4 class="text-center">
            Total: <?= number_format($valor_total, 2, ',', '.') ?>€
        </h4>
    </div>

    <h2 class="text-center">Dados do Cliente</h2>

    <form action="finalizar_compra.php" method="post" class="formulario">
        <div class="mb-3">
            <label class="form-label">Nome</label>
            <input type="text" name="nome" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Data de Nascimento</label>
            <input type="date" name="data_nascimento" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Morada</label>
            <input type="text" name="morada" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-success concluirtransicao">
            Concluir Compra
        </button>
    </form>
</div>

</body>
</html>
