<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Lista de libros</title>
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <link href="./styles.css" rel="stylesheet" type="text/css" />
</head>

<body>
  <?php include "./nav.php" ?>

  <div class="container">
    <h1>Lista de libros</h1>

    <table class="table" border="1">
      <thead class="thead-dark">
        <tr>
          <th scope="col">ID</th>
          <th scope="col">Titulo</th>
          <th scope="col">Author</th>
          <th scope="col">ISBN</th>
          <th scope="col">Numero de edicion</th>
          <th scope="col">Costo diario</th>
          <th scope="col">Estado</th>
        </tr>
      </thead>
      <tbody>

        <?php

        include "./local_libreria.php";
        $libros = new Libro();
        $Alldata = $libros->getLibros();
        ?>

        <?php foreach ($Alldata as $row): ?>


          <tr>
            <th scope='row'><?= $row['id_libro'] ?></th>
            <td><?= $row['titulo'] ?></td>
            <td><?= $row['author'] ?></td>
            <td><?= $row['ISBN'] ?></td>
            <td><?= $row['numero_edicion'] ?></td>
            <td><?= $row['costo_diario'] ?></td>
            <td><?= $row['estado'] ?></td>
          </tr>
        <?php endforeach; ?>

      </tbody>
    </table>
  </div>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>