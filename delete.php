<?php
require 'banco.php';

$id = 0;

if(!empty($_GET['id']))
{
    $id = $_REQUEST['id'];
}

if(!empty($_POST))
{
    $id = $_POST['id'];

    //Delete do banco:
    $pdo = Banco::conectar();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "DELETE FROM pessoa where id = ?";
    $q = $pdo->prepare($sql);
    $q->execute(array($id));
    Banco::desconectar();
    header("Location: index.php");
}
?>

<?php include('header.php'); ?>

<div class="jumbotron bg-danger">

    <div class="container">
    
        <h1 class="display-4 text-light">Excluir usuário</h1>

  </div>

</div>

<div class="container">

    <h3 class="text-light">Tem certeza que deseja excluir o usuário?</h3>

    <form class="form-horizontal" action="delete.php" method="post">

        <input type="hidden" name="id" value="<?php echo $id;?>" />

        <div class="form actions">
            <button type="submit" class="btn btn-danger btn-lg rounded-pill text-uppercase px-5">Sim</button>
            <a href="index.php" type="btn" class="btn btn-default text-light">Não</a>
        </div>

    </form>

</div>

<?php include('footer.php'); ?>
