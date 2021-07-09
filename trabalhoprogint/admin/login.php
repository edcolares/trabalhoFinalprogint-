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

	<link rel="stylesheet" type="text/css" href="css/style.css">

	<title>Painel de Acesso - Área Administrativa</title>

</head>

<body>

	<div class="container">
		<form class="form-login" action="" method="post">
			<h1 class="login">Painel de Acesso</h1>
			<input type="email" id="email" name="email" class="form-email" placeholder="Email*" required="" autofocus="">
			<input type="password" id="senha" name="senha" class="form-senha" placeholder="Senha*" required="">
			<br>
			<?php
			logar($conexao);
			?>
			<button class="btn_logar" type="submit" name='logar' data-toggle="tooltip" title="Logar">Logar</button>
		</form>
		

	</div>

</body>

</html>