<?php include('header.php'); ?>

        <div class="container">
          <div class="jumbotron">
            <div class="row">
                <h2>CRUD em PHP <span class="badge badge-secondary">v 1.0.0 Glaucia</span></h2>
            </div>
          </div>
            </br>
            <div class="row">
                <p>
                    <a href="create.php" class="btn btn-success">Adicionar</a>
                </p>
                <table class="table table-striped">
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
                            echo '<td width=250>';
                            echo '<a class="btn btn-primary" href="read.php?id='.$row['id'].'">Info</a>';
                            echo ' ';
                            echo '<a class="btn btn-warning" href="update.php?id='.$row['id'].'">Atualizar</a>';
                            echo ' ';
                            echo '<a class="btn btn-danger" href="delete.php?id='.$row['id'].'">Excluir</a>';
                            echo '</td>';
                            echo '</tr>';
                        }
                        Banco::desconectar();
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    
<?php include('footer.php'); ?>