<?php
session_start();
require_once 'config/basedados.php';

$produtos = $pdo->query(
    "SELECT produtoID, nome, preco, quantidade FROM produtos"
)->fetchAll();

$quantidades = [];
foreach ($produtos as $p) {
    $quantidades[$p['produtoID']] = (int)$p['quantidade'];
}
?>
<!doctype html>
<html lang="pt">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Loja Online - Rui Silva</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://kit.fontawesome.com/09a73467b8.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<style>
/* NAV */
.container-nav { background: lightgrey; }
.teste { max-width: 1100px; margin: 10px auto; }
.nav-link { margin-left: 30px; }
.nav-link-custom:hover { color: blue; }

/* HEADER */
.container-top { max-width: 1100px; margin: 0 auto; }

/* PRODUTOS */
.cards { max-width: 1100px; margin: 0 auto; }
.cards .row {
    display: flex;
    justify-content: space-between;
    gap: 20px;
}
.cards .card {
    flex: 0 0 calc(25% - 20px);
    margin-bottom: 30px;
}
.quantidade-container {
    display: flex;
    justify-content: center;
    align-items: center;
}
.quantidade {
    width: 50px;
    text-align: center;
}
.btn-quantidade {
    width: 30px;
    height: 30px;
    border: 1px solid #ccc;
    background: #f8f9fa;
    cursor: pointer;
}
.btn-quantidade:hover { background: #e2e6ea; }
.comprar { margin-top: 15px; }

/* CARRINHO */
.container-valor {
    background: lightgrey;
    display: flex;
    justify-content: center;
}
.container-valor .valores {
    max-width: 1100px;
    margin: 0 auto;
}

/* CONTACTOS */
.container-contacto {
    background: black;
    color: white;
    display: flex;
    justify-content: center;
}
.container-contacto .contactos {
    max-width: 1100px;
    margin: 0 auto;
    padding: 20px;
}

/* FOOTER */
#creditos {
    text-align: center;
    padding: 20px;
}
.fa-brands {
    font-size: 20px;
    padding: 10px;
}
#linkbilheteemail {
    color: black;
    text-decoration: none;
}
</style>
</head>

<body>

<!-- NAV -->
<div class="container-nav">
<nav class="teste navbar navbar-expand-lg">
  <div class="container-fluid">
    <a class="navbar-brand">Loja Online</a>
    <div class="collapse navbar-collapse">
      <ul class="navbar-nav me-auto">
        <li class="nav-item"><a class="nav-link nav-link-custom" href="#">Quem somos</a></li>
      </ul>
      <a class="btn btn-outline-dark" href="loginadmin.php">Página Administração</a>
    </div>
  </div>
</nav>
</div>

<br>

<!-- HEADER -->
<div class="container-top">
Loja Online, um espaço onde pode ter serviços de televisão, internet, telefone e telemóvel.
</div>

<br>

<!-- PRODUTOS -->
<div class="container mt-4 cards">
<div class="row">

<?php foreach ($produtos as $produto): ?>
<div class="card">
<?php
$img = "imagem/produto{$produto['produtoID']}.png";
?>
<img src="<?= file_exists($img) ? htmlspecialchars($img) : 'imagem/default.png' ?>"
     class="card-img-top"
     alt="<?= htmlspecialchars($produto['nome']) ?>">

<div class="card-body text-center">
  <p><?= htmlspecialchars($produto['nome']) ?></p>
  <p><?= number_format($produto['preco'],2,',','.') ?>€</p>
  <p>Disponíveis: <?= $produto['quantidade'] ?></p>

  <div class="quantidade-container">
    <div class="btn-quantidade" onclick="alterarQuantidade(this,-1)">-</div>
    <input type="number" class="quantidade" value="1" min="1" max="<?= $produto['quantidade'] ?>">
    <div class="btn-quantidade" onclick="alterarQuantidade(this,1)">+</div>
  </div>

  <button class="btn btn-primary comprar mt-2"
          data-produto-id="<?= $produto['produtoID'] ?>"
          data-produto="<?= htmlspecialchars($produto['nome']) ?>"
          data-preco="<?= $produto['preco'] ?>">
    Comprar
  </button>
</div>
</div>
<?php endforeach; ?>

</div>
</div>

<!-- CARRINHO -->
<div class="container-valor mt-4">
<div class="valores p-3">
  <div>Produtos escolhidos:</div>
  <ul id="produtos-lista"></ul>
  <div>Valor total: <span id="valor-total">0.00</span>€</div>
  <button class="btn btn-success mt-2" id="concluir-compra">Concluir Compra</button>
</div>
</div>

<!-- CONTACTOS -->
<div class="container-contacto">
<div class="contactos">
<h3>Contactos</h3>
<p><i class="fas fa-location-dot"></i> R. Cidade de Halle 7 / 9 Cave Direita, 3000-107 Coimbra</p>
<p><i class="fas fa-phone"></i> TEL: 912387465 / TEF: 239019234</p>
<p><i class="fas fa-envelope"></i> emailcontacto@gmail.com</p>
</div>
</div>

<!-- FOOTER -->
<div id="creditos">
<a id="linkbilheteemail" href="#"><i class="fa-brands fa-instagram"></i></a>
<a id="linkbilheteemail" href="#"><i class="fa-brands fa-facebook"></i></a>
<a id="linkbilheteemail" href="#"><i class="fa-brands fa-pinterest"></i></a>
<a id="linkbilheteemail" href="#"><i class="fa-brands fa-linkedin"></i></a>
<a id="linkbilheteemail" href="#"><i class="fa-brands fa-twitter"></i></a>
<h4>Feito por Rui Silva</h4>
</div>

<script>
document.addEventListener('DOMContentLoaded', () => {
const botoes = document.querySelectorAll('.comprar');
const lista = document.getElementById('produtos-lista');
const totalElem = document.getElementById('valor-total');
let total = 0;
const quantidades = <?= json_encode($quantidades) ?>;

botoes.forEach(btn => {
  btn.addEventListener('click', () => {
    const produto = btn.dataset.produto;
    const preco = parseFloat(btn.dataset.preco);
    const qInput = btn.closest('.card-body').querySelector('.quantidade');
    const qtd = parseInt(qInput.value);

    if (qtd > quantidades[btn.dataset.produtoId]) {
      alert('Stock insuficiente');
      return;
    }

    quantidades[btn.dataset.produtoId] -= qtd;
    const subtotal = preco * qtd;
    total += subtotal;
    totalElem.textContent = total.toFixed(2);

    const li = document.createElement('li');
    li.textContent = `${produto} - ${qtd} x ${preco}€ = ${subtotal.toFixed(2)}€`;
    lista.appendChild(li);
  });
});

document.getElementById('concluir-compra').onclick = () => {
  if (!lista.children.length) {
    alert('Nenhum produto selecionado');
    return;
  }
  window.location.href = 'formulario_compra.php';
};
});

function alterarQuantidade(el, delta) {
  const input = el.parentElement.querySelector('.quantidade');
  let v = parseInt(input.value) || 1;
  input.value = Math.max(1, v + delta);
}
</script>

</body>
</html>
