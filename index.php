<?php include('header.php'); ?>

<div class="jumbotron bg-danger">

    <div class="container">
    
        <h1 class="display-4 text-light">Teste para Athenas</h1>
        <p class="lead text-light">Desenvolvimento de um sistema CRUD na linguagem PHP</p>
        <hr class="my-4">
        <p class="text-light">Criado por: <a class="text-light" href="http://ramonmorales.com.br">Ramon Morales</a></p>

        <a class="btn btn-warning btn-lg rounded-pill px-4" href="create.php" role="button"><svg width="1.5em" height="1.5em" viewBox="0 0 16 16" class="bi bi-person-plus mr-2" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
  <path fill-rule="evenodd" d="M8 5a2 2 0 1 1-4 0 2 2 0 0 1 4 0zM6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm6 5c0 1-1 1-1 1H1s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C9.516 10.68 8.289 10 6 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10zM13.5 5a.5.5 0 0 1 .5.5V7h1.5a.5.5 0 0 1 0 1H14v1.5a.5.5 0 0 1-1 0V8h-1.5a.5.5 0 0 1 0-1H13V5.5a.5.5 0 0 1 .5-.5z"/>
</svg> Adicionar usuário</a>
  </div>

</div>

<div class="container">

    <div class="table-responsive">

        <table class="table table-hover table-dark">
        <thead>
            <tr>
                <th scope="col">Id</th>
                <th scope="col">Nome</th>
                <th scope="col">Email</th>
                <th scope="col">Categoria</th>
                <th scope="col">Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php
            include 'banco.php';
            $pdo = Banco::conectar();
            $sql = 'SELECT * FROM pessoa ORDER BY id ASC';

            foreach($pdo->query($sql)as $row)
            {
                echo '<tr>';
                echo '<th scope="row">'. $row['id'] . '</th>';
                echo '<td>'. $row['nome'] . '</td>';
                echo '<td>'. $row['email'] . '</td>';
                echo '<td>'. $row['categoria'] . '</td>';
                echo '<td width=300>';
                echo '<div class="d-flex justify-content-between align-items-center">';
                echo '<a class="btn btn-secondary rounded-pill px-4 mr-2" href="update.php?id='.$row['id'].'"><svg width="1.5em" height="1.5em" viewBox="0 0 16 16" class="bi bi-pencil mr-2" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5L13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175l-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/>
              </svg> Editar</a>';
                echo '<a class="btn btn-danger rounded-pill px-4" href="delete.php?id='.$row['id'].'"><svg width="1.5em" height="1.5em" viewBox="0 0 16 16" class="bi bi-trash mr-2" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4L4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
              </svg> Excluir</a>';
                echo '</div>';
                echo '</tr>';
            }
            Banco::desconectar();
            ?>
        </tbody>
        </table>

    </div>

</div>
    
<?php include('footer.php'); ?>