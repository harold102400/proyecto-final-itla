<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Lista de clientes libreria</title>
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <link href="./styles.css" rel="stylesheet" type="text/css" />
</head>

<body>
  <?php include "./nav.php" ?>

  <div class="container">
    <h1>Lista de clientes libreria</h1>

    <table class="table" border="1">
      <thead class="thead-dark"> 
        <tr>
          <th scope="col">ID</th>
          <th scope="col">Nombre</th>
          <th scope="col">Telefono</th>
      </thead>
      <tbody>
        <?php

        include "./local_libreria.php";
        $clientes = new Cliente();
        $Alldata = $clientes->getClientes();
        ?>

        <?php foreach ($Alldata as $row): ?>
          <tr>
            <th scope='row'><?= $row['id_cliente'] ?></th>
            <td><?= $row['nombre'] ?></td>
            <td><?= $row['numero_telefono'] ?></td>
          </tr>
        <?php endforeach; ?>

      </tbody>
    </table>
  </div>

</body>

</html>

<?php


?>