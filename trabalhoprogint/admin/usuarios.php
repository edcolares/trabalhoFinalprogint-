<?php require_once "../config.php";session_start();
if (isset($_SESSION['ativa'])): ?>
<!DOCTYPE html>
<html>
<head>
	<title>Painel ADMIN</title>
</head>
<body>
	<h1>Área Administrativa</h1>
	<?php 
		$tabela = "usuarios";
		$where = "id = ".$_SESSION['id'];
		$userLogado = resultado($conexao, $tabela, $where);		
	?>
	<h2>Bem vindo, <?php echo $userLogado['nome']; ?></h2>

	<?php include "template/menu.php"; ?>

	<hr>
	<div>

		<?php 

		$required = isset($_GET['usuario_id']) ? "" : "required";
		$atualizarInserir = isset($_GET['usuario_id']) ? "atualizar" : "cadastrar";
		$valNome = "";
		$valEmail = "";
		$data_registro = "";


		if (isset($_GET['usuario_id'])) {		
			$buscar = "SELECT * FROM `usuarios` WHERE id = ".$_GET['usuario_id'];			
			$executarBusca = mysqli_query($conexao, $buscar);
			$usuarioEdit = mysqli_fetch_assoc($executarBusca);
			//print_r($usuarioEdit);
			$usuario_id = $usuarioEdit['id'];
			$valNome = $usuarioEdit['nome'];
			$valEmail = $usuarioEdit['email'];
			$data_registro = $usuarioEdit['data_registro'];

			if (isset($_POST['atualizar'])) {				
				updateUser($conexao, $usuario_id);
			}
		}
		?>





		<form method="post">
			<fieldset>
				<legend>Inserir novo Usuário</legend>

				<input type="hidden" name="id" value="<?php echo $usuario_id; ?>">

				<input type="text" value="<?php echo $valNome; ?>" name="nome" placeholder="Nome do usuário" required>
				<input type="email" value="<?php echo $valEmail; ?>" name="email" placeholder="E-mail do usuário" required>
				<input type="password" name="senha" placeholder="Crie uma senha" <?php echo $required; ?> >
				<input type="password" name="repetesenha" placeholder="Repita sua senha" <?php echo $required; ?> >

				<?php if (isset($_GET['usuario_id'])) { ?>
					<input type="date" value="<?php echo $data_registro; ?>" name="data_registro">
				<?php } ?>

				<input type="submit" name="<?php echo $atualizarInserir; ?>" value="Salvar">

			</fieldset>
		</form>

		<?php 		
		if(isset($_POST['cadastrar'])){
			insertUser($conexao);
		}
		?>
		<table border="1">
			<thead>
				<tr>
					<th>Nome do Usuário</th>
					<th>E-mail</th>
					<th colspan="2">Data de Cadastro</th>
				</tr>				
			</thead>
			<tbody>
				<?php 
					$usuarios = resultados($conexao, "usuarios",1, "nome");
				?>
				<?php foreach ($usuarios as $usuario) { ?>
					<tr>
						<td><?php echo $usuario['nome']; ?></td>
						<td><?php echo $usuario['email']; ?></td>
						<td><?php echo $usuario['data_registro']; ?></td>
						<td>
							<?php if ($_SESSION['id'] == $usuario['id']) { ?>
								Seu usuário
							<?php } else { ?>							
							<a href="usuario_delete.php?usuario_id=<?php echo $usuario['id']; ?>">Deletar</a>
							<?php } ?>
							 - <a href="usuarios.php?usuario_id=<?php echo $usuario['id']; ?>">Editar</a>
						</td>
					</tr>
				<?php } ?>

			</tbody>

		</table>
	</div>

</body>
</html>
<?php else:
	logout();
endif;
?>