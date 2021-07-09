<?php require_once "../config.php";
session_start();
if (isset($_SESSION['ativa'])) : ?>
	<!DOCTYPE html>
	<html>

	<head>
		<title>Painel ADMIN</title>
		<script type="text/javascript" src="tinymce/tinymce.min.js"></script>
	</head>

	<body>
		<h1>Área Administrativa</h1>
		<?php
		$tabela = "usuarios";
		$where = "id = " . $_SESSION['id'];
		$userLogado = resultado($conexao, $tabela, $where);
		?>
		<h2>Bem vindo, <?php echo $userLogado['nome']; ?></h2>

		<?php include "template/menu.php"; ?>

		<hr>
		<div>

			<?php
			$atualizarInserir = isset($_GET['pagina_id']) ? "atualizar" : "cadastrar";
			$pagina_id = "";
			$titulo = "";
			$descricao = "";
			$meta_descricao = "";
			$data_cadastro = "";
			$publicado = "";
			$categoria = "";
			$imagem = "";
			$link = "";

			if (isset($_GET['pagina_id'])) {
				$buscar = "SELECT * FROM `paginas` WHERE id = " . $_GET['pagina_id'];
				$executarBusca = mysqli_query($conexao, $buscar);
				$pageEdit = mysqli_fetch_assoc($executarBusca);

				$pagina_id = $pageEdit['id'];
				$titulo = $pageEdit['titulo'];
				$descricao = $pageEdit['descricao'];
				$meta_descricao = $pageEdit['meta_descricao'];
				$data_cadastro = $pageEdit['data_cadastro'];
				$publicado = $pageEdit['publicado'];
				$categoria = $pageEdit['categoria'];
				$imagem = $pageEdit['imagem'];
				$link = $pageEdit['link'];

				if (isset($_POST['atualizar'])) {
					updatePage($conexao, $pagina_id);
				}
			}
			?>
			<h1>Inserir / Editar Página</h1>

			<!-- enctype="multipart/form-data" tem que colocar, senao nao funciona o link imagens -->
			<form method="post" enctype="multipart/form-data">
				<fieldset>
					<div>
						<input type="file" name="imagem">
					</div>

					<?php if (!empty($image)) { ?>
						<div class="imagem">
							<img src="imagens/imagens-pagina/<?php echo $imagem ?>" alt="image">
						</div>
					<?php } ?>

					<div>
						<input type="text" name="link" value="<?php echo $link; ?>" placeholder="Link" required>
					</div>



					<input type="file" name="link" id="link" value="<?php echo $link; ?>" placeholder="Link">

					<div>
						<select name="publicado" required>
							<?php if ($publicado > 0) {
								echo '<option value="1">Publicado</option>';
							} else {
								echo '<option value="0">Despublicado</option>';
							} ?>
							<option value="1">Publicado</option>
							<option value="0">Despublicado</option>
						</select>
					</div>
					<div>
						<select name="categoria" required>
							<?php if (!empty($categoria)) {
								echo '<option>' . $categoria . '</option>';
							} ?>
							<option>Páginas</option>
							<option>Notícias</option>
						</select>
					</div>
					<div>
						<input type="text" value="<?php echo $titulo; ?>" name="titulo" placeholder="Título" required>
					</div>
					<div>
						<textarea id="editor" placeholder="descricao" name="descricao"><?php echo $descricao; ?></textarea>
					</div>
					<div>
						<textarea placeholder="meta_descricao" name="meta_descricao" required><?php echo $meta_descricao; ?></textarea>
					</div>
					<div>
						<input type="date" value="<?php echo $data_cadastro; ?>" name="data_cadastro">
					</div>
					<div>
						<input type="submit" name="<?php echo $atualizarInserir; ?>" value="Salvar">
					</div>

				</fieldset>
			</form>

			<?php
			if (isset($_POST['cadastrar'])) {
				insertPage($conexao);
			}
			?>

		</div>

		<script>
			//https://www.tiny.cloud/get-tiny/self-hosted/
			//https://www.tiny.cloud/docs/quick-start/
			/*tinymce.init({
			  selector: '#editor'
			});*/
			tinymce.init({
				selector: '#editor',
				height: 300,
				plugins: [
					'advlist autolink link image lists charmap print preview hr anchor pagebreak',
					'searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking',
					'table emoticons template paste help'
				],
				toolbar: 'undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | ' +
					'bullist numlist outdent indent | link image | print preview media fullpage | ' +
					'forecolor backcolor emoticons | help',
				menu: {
					favs: {
						title: 'My Favorites',
						items: 'code visualaid | searchreplace | emoticons'
					}
				},
				menubar: 'favs file edit view insert format tools table help',

			});
		</script>

	</body>

	</html>
<?php else :
	logout();
endif;
?>