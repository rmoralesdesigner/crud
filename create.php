

<?php
require 'banco.php';
//Acompanha os erros de validação

// Processar so quando tenha uma chamada post
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nomeErro = null;
    $emailErro = null;
    $categoriaErro = null;

    if (!empty($_POST)) {
        $validacao = True;
        $novoUsuario = False;
        if (!empty($_POST['nome'])) {
            $nome = $_POST['nome'];
        } else {
            $nomeErro = 'Por favor digite o seu nome!';
            $validacao = False;
        }


        if (!empty($_POST['email'])) {
            $email = $_POST['email'];
            if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
                $emailErro = 'Por favor digite um endereço de email válido!';
                $validacao = False;
            }
        } else {
            $emailErro = 'Por favor digite um endereço de email!';
            $validacao = False;
        }


        if (!empty($_POST['categoria'])) {
            $categoria = $_POST['categoria'];
        } else {
            $categoriaErro = 'Por favor selecione uma categoria!';
            $validacao = False;
        }
    }

//Inserindo no Banco:
    if ($validacao) {
        $pdo = Banco::conectar();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "INSERT INTO pessoa (nome, email, categoria) VALUES(?,?,?)";
        $q = $pdo->prepare($sql);
        $q->execute(array($nome, $email, $categoria));
        Banco::desconectar();
        header("Location: index.php");
    }
}
?>


<?php include('header.php'); ?>

<div class="jumbotron bg-danger">

    <div class="container">
    
        <h1 class="display-4 text-light">Adicionar usuário</h1>

  </div>

</div>

<div class="container">

    <form class="form-row" action="create.php" method="post">

        <div class="form-group col-12 col-lg-6 <?php echo !empty($nomeErro) ? 'error ' : ''; ?>">

            <label class="text-warning" for="Nome">Nome</label>

            <input type="text" class="form-control" name="nome" id="Nome" placeholder="João da Silva" value="<?php echo !empty($nome) ? $nome : ''; ?>">

            <?php if (!empty($nomeErro)): ?>
                <span class="text-danger"><?php echo $nomeErro; ?></span>
            <?php endif; ?>``

        </div>

        <div class="form-group col-12 col-lg-6 <?php echo !empty($emailErro) ? 'error ' : ''; ?>">

            <label class="text-warning" for="Email">Email</label>

            <input type="email" class="form-control" name="email" id="Email" placeholder="joao@gmail.com" value="<?php echo !empty($email) ? $email : ''; ?>">

            <?php if (!empty($emailErro)): ?>
                <span class="text-danger"><?php echo $emailErro; ?></span>
            <?php endif; ?>``

        </div>

        <div class="form-group col-12 <?php !empty($categoriaErro) ? 'echo($categoriaErro)' : ''; ?>">

            <p class="text-warning">Categoria</p>
        
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="categoria" id="inlineRadio1" value="1" <?php isset($_POST["categoria"]) && $_POST["categoria"] == "1" ? "checked" : null; ?>>
                <label class="form-check-label text-light" for="inlineRadio1">Admin</label>
            </div>

            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="categoria" id="inlineRadio2" value="2" <?php isset($_POST["categoria"]) && $_POST["categoria"] == "2" ? "checked" : null; ?>>
                <label class="form-check-label text-light" for="inlineRadio2">Gerente</label>
            </div>

            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="categoria" id="inlineRadio3" value="3" <?php isset($_POST["categoria"]) && $_POST["categoria"] == "3" ? "checked" : null; ?>>
                <label class="form-check-label text-light" for="inlineRadio3">Normal</label>
            </div>

        </div>
        
        <div class="d-flex justify-content-between align-items-center col-12 mt-5">
        
        <button type="submit" class="btn btn-success btn-lg rounded-pill text-uppercase px-4"><svg width="1.5em" height="1.5em" viewBox="0 0 16 16" class="bi bi-person-check mr-2" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
  <path fill-rule="evenodd" d="M8 5a2 2 0 1 1-4 0 2 2 0 0 1 4 0zM6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm6 5c0 1-1 1-1 1H1s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C9.516 10.68 8.289 10 6 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10zm4.854-7.85a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 0 1 .708-.708L12.5 7.793l2.646-2.647a.5.5 0 0 1 .708 0z"/>
</svg> Salvar</button>
        <a href="index.php" type="btn" class="text-light"><svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-arrow-left" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
  <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z"/>
</svg> Voltar</a>

        </div>

        
    </form>

</div>

<?php include('footer.php'); ?>

