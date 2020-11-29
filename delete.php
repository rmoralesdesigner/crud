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
            <button type="submit" class="btn btn-danger btn-lg rounded-pill px-4"><svg width="1.5em" height="1.5em" viewBox="0 0 16 16" class="bi bi-check-circle mr-2" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
  <path fill-rule="evenodd" d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
  <path fill-rule="evenodd" d="M10.97 4.97a.75.75 0 0 1 1.071 1.05l-3.992 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.236.236 0 0 1 .02-.022z"/>
</svg> Sim</button>
            <a href="index.php" type="btn" class="btn btn-default text-light"><svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-x-circle mr-2" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
  <path fill-rule="evenodd" d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
  <path fill-rule="evenodd" d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
</svg> Não</a>
        </div>

    </form>

</div>

<?php include('footer.php'); ?>
