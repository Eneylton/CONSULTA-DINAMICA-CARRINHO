<?php
session_start();
include_once "config.php";
?>
<!DOCTYPE HTML>
<html lang="pt-BR">

<head>
	<meta charset=UTF-8>
	<title>Busca Carrinho</title>
	<link href="css/style.css" type="text/css" rel="stylesheet" />
	<script type="text/javascript" src="js/jquery.js"></script>
	<script type="text/javascript" src="js/functions.js"></script>
</head>

<body>
	<form action="" method="post" enctype="multipart/form-data" id="form_busca">
		<label>
			<span>Buscar Produto</span>
			<input type="text" name="buscar" id="busca" />
			<select id="select" name="select">
				<option value="">selecte</option>
				<option value="div1">div1</option>
				<option value="div2">div2</option>
				<option value="div3">div3</option>
			</select>
		</label>
	</form>

	<div id="pai">

		<div id="div1">

			<input text="text" name="01" placeholder="01">

		</div>

		<div id="div2">

			<input text="text" name="02" placeholder="02">

		</div>

		<div id="div3">

			<input text="text" name="03" placeholder="03">

		</div>

	</div>

	<div id="resultado_busca"></div>

	<form action="" method="post" enctype="multipart/form-data">
		<table border="0" cellpadding="0" cellspacing="0" width="80%">
			<thead>
				<tr>
					<td>Produto</td>
					<td>Valor</td>
					<td>Qtd</td>
					<td>Subtotal</td>
				</tr>
			</thead>

			<tbody id="content_retorno">
				<?php
				$total = 0;
				if (count($_SESSION['carrinho']) > 0) :
					foreach ($_SESSION['carrinho'] as $idProd => $qtd) {
						$pegaProduto = $pdo->prepare("SELECT * FROM `produtos` WHERE `id` = ?");
						$pegaProduto->execute(array($idProd));
						$dadosProduto = $pegaProduto->fetchObject();
						$subTotal = ($dadosProduto->preco * $qtd);
						$total += $subTotal;

						echo '<tr><td>' . utf8_encode($dadosProduto->nome) . '</td><td>Valor</td><td><input type="text" id="qtd" value="' . $qtd . '" size="3" /></td>';
						echo '<td>R$ ' . number_format($subTotal, 2, ',', '.') . '</td></tr>';
					}
					echo '<tr><td colspan="3">Total</td><td id="total">R$ ' . number_format($total, 2, ',', '.') . '</td></tr>';
				endif;
				?>
			</tbody>
		</table>
		<input type="submit" value="Concluir compra" class="botao" />
	</form>
</body>

</html>