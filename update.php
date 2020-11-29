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
        
        <button type="submit" class="btn btn-success btn-lg rounded-pill text-uppercase px-5">Salvar</button>
        <a href="index.php" type="btn" class="text-light">Voltar</a>

        </div>

        
    </form>

</div>


<?php include('footer.php'); ?>
