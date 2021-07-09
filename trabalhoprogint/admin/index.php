<?php session_start();
require_once "../config.php";
if (isset($_SESSION['ativa'])) : ?>
	<!DOCTYPE html>
	<html lang="pt-br">

	<head>
		<!-- Meta tags Obrigatórias -->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

		<!-- Bootstrap CSS -->
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

		<!-- LINK FONT GOOGLE -> KOHO -->
		<link rel="preconnect" href="https://fonts.googleapis.com">
		<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
		<link href="https://fonts.googleapis.com/css2?family=KoHo:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;1,200;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet">

		<!-- LINK FONT GOOGLE -> ROBOTO -->
		<link rel="preconnect" href="https://fonts.googleapis.com">
		<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
		<link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">

		<link rel="stylesheet" href="css/style.css">
		<title>Área Administrativa</title>


	</head>

	<body>


		<?php
		$tabela = "usuarios";
		$where = "id = " . $_SESSION['id'];
		$userLogado = resultado($conexao, $tabela, $where);
		?>

		<!-- CONTAINER -> .container-fluid para um container com de largura total -->
		<div class="container">

			<!-- AREA DE TOPO: ARQUIVO TOPO_NAV.PHP -->
			<div class="row">
				<div class="col-sm-12">
					<?php include "template/topo_nav.php"; ?>
				</div>
			</div>

			<!-- AREA CENTRAL: MENU ESQUERDO + AREA DE CONTEUDO -->
			<div class="row">
				<!-- MENU ESQUERDO -->
				<div class="col-sm-3">
					<?php include "template/area_central_menu.php"; ?>
				</div>
				<!-- AREA DE CONTEUDO -->
				<div class="col-sm-9">
					class="col-8"class="col-8"class="col-8"class="col-8"class="col-8"class="col-8"class="col-8"class="col-8"class="col-8"class="col-8"class="col-8"class="col-8"class="col-8"class="col-8"class="col-8"class="col-8"class="col-8"class="col-8"class="col-8"class="col-8"class="col-8"class="col-8"class="col-8"class="col-8"class="col-8"class="col-8"class="col-8"class="col-8"class="col-8"class="col-8"class="col-8"class="col-8"class="col-8"class="col-8"class="col-8"class="col-8"class="col-8"class="col-8"class="col-8"class="col-8"class="col-8"class="col-8"class="col-8"
				</div>
			</div>

			<!-- RODAPE -->

			<div class="row">
				<div class="col-sm-12">
					Lorem ipsum dolor sit amet consectetur adipisicing elit. Aspernatur, iusto eos eum voluptates cumque, deleniti unde commodi libero est, nisi quam! Corporis laboriosam illo esse recusandae eum temporibus reiciendis deserunt.
				</div>
			</div>

		</div>

		<!-- FIM CONTAINER -->

		<!-- USO BOOTSTRAP -->
		<!-- jQuery primeiro, depois Popper.js, depois Bootstrap JS -->
		<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

	</body>

	</html>
<?php else :
	logout();
endif;
?>