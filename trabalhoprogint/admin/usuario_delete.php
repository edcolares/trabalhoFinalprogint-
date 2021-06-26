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
	<?php include "template/menu.php"; ?>

	<hr>

	<div>
		<?php 
		$idUser = $_GET['usuario_id'];
		$where = "id = ".$idUser;
		$usuario = resultado($conexao, "usuarios", $where);
		?>
		<h1>Você tem certeza que quer deletar o usuário <?php echo $usuario['nome']; ?>?</h1>

		<form method="post">
			<input type="hidden" name="usuario_id" value="<?php echo $usuario['id']; ?>">
			<input type="submit" name="deletar" value="Deletar">
		</form>

		<?php 
			if (isset($_POST['deletar'])) {
				$id = $_POST['usuario_id'];
				if(!empty($id) AND $id != $_SESSION['id']){
					$delete = deletar($conexao, "usuarios", $id);
					if ($delete) {
						echo '<script>window.location.href = "usuarios.php"</script>';
					} else{
						echo "Erro ao Deletar";
					}
				}else{
					echo "Você não pode deletar seu próprio usuário!";
				}
			}

		?>
		
	</div>

</body>
</html>
<?php else:
	logout();
endif;
?>