<?php require_once "../config.php";
logar($conexao);
?>
<!DOCTYPE html>
<html>

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

	<title>Painel de Acesso - Área Administrativa</title>
	<style>

		.container-fluid {
			width: 100%;
			max-width: 330px;
			padding: 30px;
			margin: 0 auto;
			background-color: #fff;
			border-radius: 2%;
		}
	</style>

</head>

<body>

	<div class="form-group container-fluid">

		<form class="form-signin" action="" method="post">
			<h1 class="h3 mb-3 font-weight-normal">Painel de Acesso</h1>
			<label for="inputEmail" class="sr-only">Email</label>
			<input type="email" id="email" name="email" class="form-control" placeholder="Email" required="" autofocus="">

			<label for="inputPassword" class="sr-only">Senha</label>
			<input type="password" id="senha" name="senha" class="form-control" placeholder="Senha" required="">

			<?php
			logar($conexao);
			?>

			<button class="btn btn-lg btn-primary btn-block" type="submit" name='logar'>Logar</button>
		</form>

	</div>

</body>

</html>