

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

<div class="container">
    <div clas="span10 offset1">
        <div class="card">
            <div class="card-header">
                <h3 class="well"> Adicionar Contato </h3>
            </div>
            <div class="card-body">
                <form class="form-horizontal" action="create.php" method="post">

                    <div class="control-group  <?php echo !empty($nomeErro) ? 'error ' : ''; ?>">
                        <label class="control-label">Nome</label>
                        <div class="controls">
                            <input size="50" class="form-control" name="nome" type="text" placeholder="Nome"
                                   value="<?php echo !empty($nome) ? $nome : ''; ?>">
                            <?php if (!empty($nomeErro)): ?>
                                <span class="text-danger"><?php echo $nomeErro; ?></span>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="control-group <?php !empty($emailErro) ? '$emailErro ' : ''; ?>">
                        <label class="control-label">Email</label>
                        <div class="controls">
                            <input size="40" class="form-control" name="email" type="text" placeholder="Email"
                                   value="<?php echo !empty($email) ? $email : ''; ?>">
                            <?php if (!empty($emailErro)): ?>
                                <span class="text-danger"><?php echo $emailErro; ?></span>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="control-group <?php !empty($categoriaErro) ? 'echo($categoriaErro)' : ''; ?>">
                        <div class="controls">
                            <label class="control-label">Categoria</label>
                            <div class="form-check">
                                <p class="form-check-label">
                                    <input class="form-check-input" type="radio" name="categoria" id="categoria"
                                           value="1" <?php isset($_POST["categoria"]) && $_POST["categoria"] == "1" ? "checked" : null; ?>/>
                                    Admin</p>
                            </div>
                            <div class="form-check">
                                <p class="form-check-label">
                                    <input class="form-check-input" id="categoria" name="categoria" type="radio"
                                           value="2" <?php isset($_POST["categoria"]) && $_POST["categoria"] == "2" ? "checked" : null; ?>/>
                                    Gerente</p>
                            </div>
                            <div class="form-check">
                                <p class="form-check-label">
                                    <input class="form-check-input" id="categoria" name="categoria" type="radio"
                                           value="3" <?php isset($_POST["categoria"]) && $_POST["categoria"] == "3" ? "checked" : null; ?>/>
                                    Normal</p>
                            </div>
                            <?php if (!empty($categoriaErro)): ?>
                                <span class="help-inline text-danger"><?php echo $categoriaErro; ?></span>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="form-actions">
                        <br/>
                        <button type="submit" class="btn btn-success">Adicionar</button>
                        <a href="index.php" type="btn" class="btn btn-default">Voltar</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>

<?php include('footer.php'); ?>

