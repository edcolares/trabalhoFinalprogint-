<?php
//Conectando ao Banco de dados
$servidor = "localhost";
$dbUser = "root";
$dbPass = "";
$dbName = "aula11";

$conexao = mysqli_connect($servidor, $dbUser, $dbPass, $dbName);
if (!$conexao) {
	echo "Erro: " . mysqli_connect_error();
}

function logar($conexao)
{
	if (isset($_POST['logar'])) {
		$email = mysqli_real_escape_string($conexao, $_POST['email']);
		$senha = sha1($_POST['senha']);
		$erros = array();
		if (!empty($email) and !empty($senha)) {
			$query = "SELECT * FROM `usuarios` WHERE email = '" . $email . "' AND senha = '" . $senha . "' ";
			$executar = mysqli_query($conexao, $query);
			$encontrou = mysqli_num_rows($executar);
			if ($encontrou > 0) {
				$usuario = mysqli_fetch_assoc($executar);
				// AQUI inicia a Sessão
				session_start();
				$_SESSION['ativa'] = TRUE;
				$_SESSION['id'] = $usuario['id'];
				header("location:index.php");
			} else {
				$erros[] = '<div class="alert alert-danger">
                <strong>Erro: </strong> E-mail ou Senha Inválidos </div>';
			}
		} else {
			$erros[] = '<div class="alert alert-danger">
            <strong>Erro: </strong> E-mail ou Senha estão vazios </div>';
		}

		if (!empty($erros)) {
			foreach ($erros as $erro) {
				echo "<p>" . $erro . "</p>";
			}
		}
	}
} //end function

function logout()
{
	session_unset();
	session_destroy();
	header("location:login.php");
}

//CRUD
//SELECT
function resultado($conexao, $tabela, $where = 1, $order = "id")
{
	$query = "SELECT * FROM `" . $tabela . "` WHERE " . $where . " ORDER BY " . $order;
	$executar = mysqli_query($conexao, $query);
	return mysqli_fetch_assoc($executar);
}
function resultados($conexao, $tabela, $where = 1, $order = "id")
{
	$query = "SELECT * FROM `" . $tabela . "` WHERE " . $where . " ORDER BY " . $order;
	$executar = mysqli_query($conexao, $query);
	return mysqli_fetch_all($executar, MYSQLI_ASSOC);
}

//DELETE
function deletar($conexao, $tabela, $where)
{
	if (!empty($where)) {
		$query = "DELETE FROM `" . $tabela . "` WHERE id=" . $where;
		return mysqli_query($conexao, $query);
	}
}

//INSERIR
function insertUser($conexao)
{
	$nomeUsuario = trim(mysqli_real_escape_string($conexao, $_POST['nome']));
	$emailUsuario = trim(mysqli_real_escape_string($conexao, $_POST['email']));
	$senhaUsuario = sha1($_POST['senha']);
	$repeteSenha = sha1($_POST['repetesenha']);
	if ($senhaUsuario == $repeteSenha) {
		//verifica o email enviado no formulário
		$buscar = "SELECT email FROM `usuarios` WHERE email = '" . $emailUsuario . "'";
		$executarBusca = mysqli_query($conexao, $buscar);
		$vericaEmail = mysqli_num_rows($executarBusca);
		if ($vericaEmail > 0) {
			echo "E-mail já cadastrado! Por favor Informe um novo e-mail.";
		} else {
			//Inseri no BD
			$query = "INSERT INTO `usuarios` (nome, email, senha, data_registro) VALUES ('" . $nomeUsuario . "', '" . $emailUsuario . "', '" . $senhaUsuario . "', NOW() ) ";
			$executar = mysqli_query($conexao, $query);

			if ($executar) {
				echo "Usuário Cadastrado com sucesso";
			} else {
				echo "Erro ao inserir";
			}
		} //end verificaEmail
	} else {
		echo "Senhas não conferem!";
	} // end Repete Senha			
}

function insertPage($conexao)
{
	$titulo = trim(mysqli_real_escape_string($conexao, $_POST['titulo']));
	$descricao = trim(mysqli_real_escape_string($conexao, $_POST['descricao']));
	$meta_descricao = trim(mysqli_real_escape_string($conexao, $_POST['meta_descricao']));
	$data_cadastro = $_POST['data_cadastro'];
	$categoria = trim(mysqli_real_escape_string($conexao, $_POST['categoria']));
	$publicado = trim(mysqli_real_escape_string($conexao, $_POST['publicado']));
	$link = trim(mysqli_real_escape_string($conexao, $_POST['link']));
	$imagem = !empty($_FILES['imagem']['name']) ? $_FILES['imagem'] : "";
	$nomeImagem = "";

	//inserir imagem
	if (!empty($imagem)) {
		upload($imagem, "imagens/imagens-pagina/");
		$nomeImagem = $_FILES['imagem']['name'];
	}

	//Inseri no BD

	$query = "INSERT INTO `paginas` (titulo, descricao, meta_descricao, publicado, categoria, data_cadastro, imagem, link) VALUES ('" . $titulo . "', '" . $descricao . "', '" . $meta_descricao . "', '" . $publicado . "', '" . $categoria . "', '" . $data_cadastro . "', '" . $nomeImagem . "', '" . $link . "' )";
	$executar = mysqli_query($conexao, $query);

	if ($executar) {
		echo "Página inserida com sucesso";
	} else {

		echo "Erro ao inserir a página";
	}
}

//UPDATE
function updateUser($conexao, $where)
{

	$buscarEmailAtual = "SELECT email FROM `usuarios` WHERE id = " . $where;
	$executarBuscaEmail = mysqli_query($conexao, $buscarEmailAtual);
	$emailAtual = mysqli_fetch_assoc($executarBuscaEmail);
	$valEmail = $emailAtual['email'];

	$erros = array();
	$nome = trim(mysqli_real_escape_string($conexao, $_POST['nome']));
	$email = trim(mysqli_real_escape_string($conexao, $_POST['email']));
	$data = $_POST['data_registro'];
	$senhaUsuario = $_POST['senha'];
	$repeteSenha = $_POST['repetesenha'];


	if ($senhaUsuario != $repeteSenha) {
		$erro[] = "Senhas não conferem";
	}
	//verifica o email enviado no formulário
	$buscar = "SELECT email FROM `usuarios` WHERE email = '" . $email . "' AND email != '" . $valEmail . "'";
	$executarBusca = mysqli_query($conexao, $buscar);
	$vericaEmail = mysqli_num_rows($executarBusca);
	if ($vericaEmail > 0 or !empty($erro)) {
		echo "E-mail já cadastrado! Por favor Informe um novo e-mail.";
		echo $mostraerro = !empty($erro) ? $erro[0] : "";
	} else {
		if (!empty($senhaUsuario)) {
			$query = "UPDATE `usuarios` SET nome='" . $nome . "', email='" . $email . "', senha='" . sha1($senhaUsuario) . "', data_registro='" . $data . "' WHERE id =" . $where;
		} else {
			$query = "UPDATE `usuarios` SET nome='" . $nome . "', email='" . $email . "', data_registro='" . $data . "' WHERE id =" . $where;
		}
		if (!empty($where)) {
			$executar = mysqli_query($conexao, $query);
		}

		if ($executar) {
			echo "Usuário Atualizado com sucesso";
		} else {
			echo "Erro ao Atualizar" . $query;
		}
	}
}
function updatePage($conexao, $where)
{

	$id = $_POST['id'];
	$titulo = trim(mysqli_real_escape_string($conexao, $_POST['titulo']));
	$descricao = trim(mysqli_real_escape_string($conexao, $_POST['descricao']));
	$meta_descricao = trim(mysqli_real_escape_string($conexao, $_POST['meta_descricao']));
	$data_cadastro = $_POST['data_cadastro'];
	$categoria = trim(mysqli_real_escape_string($conexao, $_POST['categoria']));
	$publicado = trim(mysqli_real_escape_string($conexao, $_POST['publicado']));
	$link = trim(mysqli_real_escape_string($conexao, $_POST['link']));

	$imagem = !empty($_FILES['imagem']['name']) ? $_FILES['imagem'] : "";
	$nomeImagem = "";

	//inserir imagem
	if (!empty($imagem)) {
		upload($imagem, "imagens/imagens-pagina/");
		$nomeImagem = $_FILES['imagem']['name'];
	}

	if (!empty($titulo)) {
		if (!empty($nomeImagem)) {
			$query = "UPDATE `paginas` SET titulo='" . $titulo . "', descricao='" . $descricao . "', meta_descricao='" . $meta_descricao . "', categoria='" . $categoria . "', publicado='" . $publicado . "', data_cadastro='" . $data_cadastro . "', link='" . $link . "', imagem='" . $nomeImagem . "' WHERE id =" . $where;
		} else {
			$query = "UPDATE `paginas` SET titulo='" . $titulo . "', descricao='" . $descricao . "', meta_descricao='" . $meta_descricao . "', categoria='" . $categoria . "', publicado='" . $publicado . "', data_cadastro='" . $data_cadastro . "', link='" . $link . "' WHERE id =" . $where;
		}

		if (!empty($where)) {
			$executar = mysqli_query($conexao, $query);
		}

		if ($executar) {
			echo "Página Atualizada com sucesso";
		} else {
			echo "Erro ao Atualizar" . $query;
		}
	}
}
/* FIM UPDATE PAGINAS */

function upload($file, $caminho)
{
	$nomeArquivo = $file['name'];
	$tmpName = $file['tmp_name'];
	$tamanho = $file['size'];
	$tipo = $file['type'];
	$extensoes = ["jpg", "png", "jpeg", "pdf"];
	$verificarExtensao = pathinfo($nomeArquivo, PATHINFO_EXTENSION);
	$typesPermitidos = ["image/png", "image/jpg", "application/pdf"];
	$tamanhoPermitido = 1024 * 1024 * 6; //6 MB



	//Veriifica a Extensão do Arquivo;

	if (!in_array($verificarExtensao, $extensoes)) {
		$erros[] = "Extensão não permitida. Aceito somente arquivos em JPG e PNG";
	}

	//Verifica mime_type do arquivo

	if (!in_array($tipo, $typesPermitidos)) {
		$erros[] = "Arquivo não permitido";
	}

	//Verificar Tamanho

	if ($tamanho > $tamanhoPermitido) {
		$erros[] = "O tamanho máximo do arquivo precisa ser de 6 MB";
	}

	if (!empty($erros)) {
		foreach ($erros as $erro) {
			echo $erro . "<br>";
		}
	} else {
		$pasta = $caminho;
		if (move_uploaded_file($tmpName, $pasta . $nomeArquivo)) {
			echo "Upload Feito com Sucesso!";
		} else {
			echo "Erro ao salvar o arquivo";
		}
	}
}
