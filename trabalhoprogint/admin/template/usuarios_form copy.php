<h2>Incluir novo usuário</h2>
<form method="post">
	<input type="hidden" name="id" value="<?php echo $usuario_id; ?>">

	<div class="form-row">
		<div class="form-group col-md-6">
			<label for="inputNome">Nome do usuário</label>
			<input type="text" class="form-control" id="inputNome" value="<?php echo $valNome; ?>" name="nome" placeholder="Nome do usuário" required>
		</div>
		<div class="form-group col-md-6">
			<label for="inputEmail">Email</label>
			<input type="email" class="form-control" id="inputEmail" value="<?php echo $valEmail; ?>" name="email" placeholder="E-mail do usuário" required>
		</div>
	</div>


	<div class="form-row">
		<div class="form-group col-md-6">
			<label for="inputPassword1">Senha</label>
			<input type="password" class="form-control" id="inputPassword1" placeholder="Crie uma senha" <?php echo $required; ?>>
		</div>
		<div class="form-group col-md-6">
			<label for="inputPassword2">Repete Senha</label>
			<input type="password" class="form-control" id="inputPassword2" placeholder="Repita sua senha" <?php echo $required; ?>>
		</div>
	</div>

	<div class="form-row">
		<div class="form-group col-md-6">
			<label for="inputDataRegistro">Data Registro</label>

			<?php if (isset($_GET['usuario_id'])) { ?>
				<input type="date" class="form-control" id="inputDataRegistro" value="<?php echo $data_registro; ?>" name="data_registro">
			<?php } ?>

		</div>
		<div class="form-group col-md-6">
			<label for="inputTipoUsuario">Tipo de Usuário</label>
			<input type="text" class="form-control" id="inputTipoUsuario" placeholder="Repita sua senha" <?php echo "1"; ?>>
		</div>
	</div>

	<div class="form-row">
		<div class="form-group col-md-12">
			<button type="submit" class="btn btn-primary" name="<?php echo $atualizarInserir; ?>" value="Salvar">Salvar</button>
		</div>
	</div>

</form>