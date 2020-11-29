<?php

require 'banco.php';

$id = null;
if (!empty($_GET['id'])) {
    $id = $_REQUEST['id'];
}

if (null == $id) {
    header("Location: index.php");
}

if (!empty($_POST)) {

    $nomeErro = null;
    $emailErro = null;
    $categoriaErro = null;

    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $categoria = $_POST['categoria'];

    //Validação
    $validacao = true;
    if (empty($nome)) {
        $nomeErro = 'Por favor digite o nome!';
        $validacao = false;
    }

    if (empty($email)) {
        $emailErro = 'Por favor digite o email!';
        $validacao = false;
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $emailErro = 'Por favor digite um email válido!';
        $validacao = false;
    }

    if (empty($categoria)) {
        $categoriaErro = 'Por favor selecione a categoria!';
        $validacao = false;
    }

    // update data
    if ($validacao) {
        $pdo = Banco::conectar();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "UPDATE pessoa  set nome = ?, email = ?, categoria = ? WHERE id = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($nome, $email, $categoria, $id));
        Banco::desconectar();
        header("Location: index.php");
    }
} else {
    $pdo = Banco::conectar();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "SELECT * FROM pessoa where id = ?";
    $q = $pdo->prepare($sql);
    $q->execute(array($id));
    $data = $q->fetch(PDO::FETCH_ASSOC);
    $nome = $data['nome'];
    $email = $data['email'];
    $categoria = $data['categoria'];
    Banco::desconectar();
}
?>

<?php include('header.php'); ?>

<div class="jumbotron bg-danger">

    <div class="container">
    
        <h1 class="display-4 text-light">Editar usuário</h1>

  </div>

</div>

<div class="container">

    <form class="form-row" action="update.php?id=<?php echo $id ?>" method="post">

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
                <input class="form-check-input" type="radio" name="categoria" id="inlineRadio1" value="1" <?php echo ($categoria == "1") ? "checked" : null; ?>>
                <label class="form-check-label text-light" for="inlineRadio1">Admin</label>
            </div>

            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="categoria" id="inlineRadio2" value="2" <?php echo ($categoria == "2") ? "checked" : null; ?>>
                <label class="form-check-label text-light" for="inlineRadio2">Gerente</label>
            </div>

            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="categoria" id="inlineRadio3" value="3" <?php echo ($categoria == "3") ? "checked" : null; ?>>
                <label class="form-check-label text-light" for="inlineRadio3">Normal</label>
            </div>

        </div>
        
        <div class="d-flex justify-content-between align-items-center col-12 mt-5">
        
        <button type="submit" class="btn btn-success btn-lg rounded-pill px-4"><svg width="1.5em" height="1.5em" viewBox="0 0 16 16" class="bi bi-person-check mr-2" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
  <path fill-rule="evenodd" d="M8 5a2 2 0 1 1-4 0 2 2 0 0 1 4 0zM6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm6 5c0 1-1 1-1 1H1s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C9.516 10.68 8.289 10 6 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10zm4.854-7.85a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 0 1 .708-.708L12.5 7.793l2.646-2.647a.5.5 0 0 1 .708 0z"/>
</svg> Salvar</button>
        <a href="index.php" type="btn" class="btn btn-default text-light"><svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-arrow-left mr-2" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
  <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z"/>
</svg> Voltar</a>

        </div>

        
    </form>

</div>


<?php include('footer.php'); ?>
