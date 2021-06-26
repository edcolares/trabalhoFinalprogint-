<nav class="navbar navbar-expand-lg navbar-light bg-light">

    <!-- LOGOTIPO E NOME NO CANTO SUPERIOR ESQUERDO -->
    <a class="navbar-brand" href="index.php">
        <i class="fas fa-user-cog"></i>


        <img src="../imagens/administration-icon.jpg" width="30" height="30" class="d-inline-block align-top" alt="">
        Área Administrativa
    </a>

    <!-- MENU HAMBURGUES -->
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Alterna navegação">
        <span class="navbar-toggler-icon"></span>
    </button>

    <!-- MENUS DA NAV -->
    <div class="collapse navbar-collapse justify-content-end" id="navbarNavDropdown">
        <ul class="navbar-nav">
            <li class="nav-item active">
                <a class="nav-link" href="index.php">Home
                    <!-- <span class="sr-only">(Página atual)</span> -->
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="paginas.php">Páginas</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="usuarios.php">Usuários</a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Bem vindo, <?php echo $userLogado['nome']; ?>
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                    <!-- EDITAR DADOS DO USUÁRIO -->
                    <a class="dropdown-item" href="#">Meu Cadastro</a>
                    <!-- FAZER LOGOUT -->
                    <a class="dropdown-item" href="sair.php">Sair</a>
                </div>
            </li>
        </ul>
    </div>
</nav>